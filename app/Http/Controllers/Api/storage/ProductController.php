<?php

namespace App\Http\Controllers\Api\Storage;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\BillProduct;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {

//        return Auth::user();
        $limit = $request->limit ?? 10;
        $products = Category::join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ward_id', '=', 'warehouses.id')
            ->groupBy('products.id')
            ->select('products.id', 'products.publish_id', 'products.images', 'products.name as name', 'categories.name as cate_name', 'products.price', 'product_warehouses.ward_id', 'product_warehouses.product_id', 'product_warehouses.amount');

//        return Auth::user();

        if ($request->key_search) {

            $products = $products->where('products.publish_id', 'like', '%' . $request->key_search . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $products = $products->where('warehouses.user_id', Auth::id())
            ->where('product_warehouses.status', '!=', 3)
            ->paginate($limit);
        foreach ($products as $pro) {
            $pro->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ward_id =" . $pro->ward_id . " AND product_id = " . $pro->product_id . ") as amount FROM product_warehouses where status = 1 AND ward_id =" . $pro->ward_id . " AND product_id = " . $pro->product_id . ""))[0]->amount ?? 0;
        }
        $this->v['products'] = $products;
        $this->v['params'] = $request->all();
//        return  $this->v;
        return response()->json([
            'status_code' => 200,
            'data' => $this->v['products']
        ], 200);
//        return view('screens.storage.product.index', $this->v);
    }

    public function request(Request $request)
    {
        $limit = $request->limit ?? 10;
        $this->v['requests'] = Product::with(['category', 'NCC'])->select('category_id',
            'products.user_id', 'product_warehouses.amount',
            'product_warehouses.id', 'product_warehouses.created_at',
            'product_warehouses.status', 'products.name')
            ->join("product_warehouses", 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ward_id', '=', 'warehouses.id');
        if ($request->key_search) {
            $this->v['requests'] = $this->v['requests']->where('product_warehouses.id', 'like', '%' . str_replace('YC', '', $request->key_search) . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $this->v['requests'] = $this->v['requests']->whereIn('product_warehouses.status', [0, 1, 5])->where('warehouses.user_id', Auth::id())->paginate($limit);

        $this->v['params'] = $request->all();
        return response()->json([
            'status_code' => 200,
            'data' => $this->v['requests']
        ], 200);
//        return view('screens.storage.product.request', $this->v);

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
//        return view('screens.storage.product.requestOut', compact('order','count'));

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    public function updateRequest($status, Request $request)
    {
        DB::table('product_warehouses')->where('id', $request->id)->update(['status' => $status]);


        return response()->json([
            'success' => true,
            'message' => 'Cập nhật yêu cầu thành công'
        ], 201);
    }

    public function updateRequestOut($status, Request $request)
    {
        DB::table('bill_details')->where('id', $request->id)->update(['export_status' => $status]);
        $billProduct = BillProduct::where('bill_detail_id', $request->id)->get();

        foreach ($billProduct as $value) {
            $productW = new ProductWarehouses();
            $productW->product_id = $value->product_id;
            $productW->ward_id = $value->ward_id;
            $productW->status = 2;
            $productW->amount = $value->quantity;
            $productW->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật yêu cầu thành công'
        ], 201);
    }

    public function detail(Request $request)
    {
        $bill_detail = BillDetail::where('id', $request->id)->first();

        $products = BillProduct::join('products', 'bill_product.product_id', '=', 'products.id')->where('bill_detail_id', $bill_detail->id)
            ->select('bill_product.code as code', 'bill_product.quantity', 'products.name as name')
            ->get();
        $total = $bill_detail->total;

        return response()->json([
            'success' => true,
            'data' => [
                'products ' => $products,
                'total' => $total
            ]
        ]);
    }
}
