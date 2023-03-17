<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\BillProduct;
use App\Models\Category;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Province;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    //
    private $v;

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $products = Category::join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->groupBy('products.id')
            ->select('products.id', 'products.publish_id', 'products.images', 'products.name as name', 'categories.name as cate_name', 'products.price', 'product_warehouses.ware_id', 'product_warehouses.product_id', 'product_warehouses.amount');

//        return Auth::user();

        if ($request->key_search) {

            $products = $products->where('products.publish_id', 'like', '%' . $request->key_search . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $products = $products->where('warehouses.user_id', Auth::id())
            ->where('product_warehouses.status', '!=', 3)
            ->paginate($limit);
        foreach ($products as $pro) {
            $pro->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ") as amount FROM product_warehouses where status = 1 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ""))[0]->amount ?? 0;
        }
        $this->v['products'] = $products;
        $this->v['params'] = $request->all();
        return view('screens.storage.product.index', $this->v);
    }

    public function request(Request $request)
    {
        $limit = $request->limit ?? 10;
        $this->v['requests'] = Product::select('category_id', 'products.user_id', 'product_warehouses.amount', 'product_warehouses.id', 'product_warehouses.created_at', 'product_warehouses.status', 'products.name')
            ->join("product_warehouses", 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id');
        if ($request->key_search) {
            $this->v['requests'] = $this->v['requests']->where('product_warehouses.id', 'like', '%' . str_replace('YC', '', $request->key_search) . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $this->v['requests'] = $this->v['requests']->whereIn('product_warehouses.status',[0,1,5])->where('warehouses.user_id', Auth::id())->paginate($limit);

        $this->v['params'] = $request->all();
        return view('screens.storage.product.request', $this->v);

    }

    public function requestOut(Request $request)
    {
        $limit = $request->limit ?? 10;

        $warehouses = Warehouses::where('user_id',Auth::id())->first();
        $order = Order::join('order_item','order.id','=','order_item.order_id')
            ->select('order.id','order.export_status','order.no','district_id','province_id','address','order.created_at','order_item.price','order_item.quantity',
                'order_item.discount_vshop','order_item.discount_ncc','order_item.discount_ncc','order_item.discount_vstore')
            ->paginate(10);
        foreach ($order as $ord){
            $ord->total = $ord->price - ($ord->price /100 );
        }

        $count = count($order);
        return view('screens.storage.product.requestOut', compact('order','count'));
    }

    public function updateRequest($status, Request $request)
    {
        DB::table('product_warehouses')->where('id', $request->id)->update(['status' => $status]);


        return redirect()->back()->with('success', 'Cập nhật đơn gửi hàng thành công');
    }
    public function updateRequestOut($status,Request $request){


//        return $request;

        $order = Order::find($request->id);
        if (!$order){
            return redirect()->back();
        }

            $login = Http::post('https://partner.viettelpost.vn/v2/user/Login', [
                'USERNAME' => config('domain.TK_VAN_CHUYEN'),
                'PASSWORD' => config('domain.MK_VAN_CHUYEN'),
            ]);

//        return $login['data']['token'];
//        $data_login = json_decode($login)->data;

        $order->export_status = $status;
        $order->save();
        $warehouse = Warehouses::find($order->warehouse_id);
        if (!$warehouse){
            return redirect()->back();
        }
        $order_item= OrderItem::where('order_id',$order->id)->first();

        $product = Product::where('id',$order_item->product_id)->first();


        if ($status ==1){
//            return $order->total;
            if ($order->method_payment == 'COD'){
                $money_colection = (int) $order->total;
                $order_payment = 2;
            }else{
                $money_colection = 0;
                $order_payment = 1;
            }

            $get_list = Http::withHeaders(
                [
                    'Content-Type'=>' application/json',
                    'Token'=>$login['data']['token']
                ]
            )->post('https://partner.viettelpost.vn/v2/order/getPriceAll',[
                'SENDER_DISTRICT'=>$warehouse->district_id,
                'SENDER_PROVINCE'=>$warehouse->city_id,
                'RECEIVER_DISTRICT'=>$order->district_id,
                'RECEIVER_PROVINCE'=>$order->province_id,
                'PRODUCT_TYPE'=>'HH',
                'PRODUCT_WEIGHT'=> $product->weight * $order_item->quantity,
                'PRODUCT_PRICE'=>$order->total - $order->shipping,
                'MONEY_COLLECTION'=>$money_colection,
                'TYPE'=>1,

            ] );
//            return $get_list;

            $tinh_thanh_gui = Province::where('province_id',$warehouse->city_id)->first()->province_name ?? '';
            $quan_huyen_gui = District::where('district_id',$warehouse->district_id)->first()->district_name ?? '';
            $tinh_thanh_nhan = Province::where('province_id',$order->province_id)->first()->province_name ?? '';
            $quan_huyen_nhan = District::where('district_id',$order->district_id)->first()->district_name ?? '';
//            return $quan_huyen_nhan;

            $list_item[] =[
                'PRODUCT_NAME'=>$product->name,
                'PRODUCT_QUANTITY'=>$order_item['quantity'],
                'PRODUCT_PRICE'=>$product->price,
                'PRODUCT_WEIGHT'=>$product->price *$order_item['quantity']
            ];
//            return $get_list[0]['MA_DV_CHINH'];
            $taodon = Http::withHeaders(
                [
                    'Content-Type'=>' application/json',
                    'Token'=>$login['data']['token']
                ]
            )->post('https://partner.viettelpost.vn/v2/order/createOrderNlp' ,[
                "ORDER_NUMBER"=>'',
                "SENDER_FULLNAME"=>$warehouse->name,
                "SENDER_ADDRESS"=>$warehouse->address .',' .$quan_huyen_gui.','.$tinh_thanh_gui,
                "SENDER_PHONE"=>$warehouse->phone_nameber,
                "RECEIVER_FULLNAME"=>$order->fullname,
                "RECEIVER_ADDRESS"=>$order->address .',' .$quan_huyen_nhan.','.$tinh_thanh_nhan,
                "RECEIVER_PHONE"=>$order->phone,
                "PRODUCT_NAME"=>$order->no,
                "PRODUCT_DESCRIPTION"=>"",
                "PRODUCT_QUANTITY"=>1,
                "PRODUCT_PRICE"=>$order->total - $order->shipping,
                "PRODUCT_WEIGHT"=>$product->weight * $order_item->quantity,
                "PRODUCT_LENGTH"=>null,
                "PRODUCT_WIDTH"=>null,
                "PRODUCT_HEIGHT"=>null,
                "ORDER_PAYMENT"=>$order_payment,
                "ORDER_SERVICE"=>$get_list[0]['MA_DV_CHINH'],
                "ORDER_SERVICE_ADD"=>null,
                "ORDER_NOTE"=>"",
                "MONEY_COLLECTION"=>0,
                "LIST_ITEM"=>$list_item,
            ]);
//            return 1;
//            return json_decode($taodon);
            $order->order_namber = json_decode($taodon)->data->ORDER_NUMBER;
            $order->save();
            return $order;
        }


        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
    }
    public function detail(Request $request)
    {
//        return $request->id;
        $order = Order::where('id',$request->id)->first();

        $products = OrderItem::join('products','order_item.product_id','=','products.id')->where('order_id',$order->id)
            ->select('order_item.id','order_item.quantity','products.publish_id','products.name as name')
            ->get();
        $total = $order->total;
//        return $products;
        return view('screens.storage.product.detailOut',compact('products','total'));

    }
}
