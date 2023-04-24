<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $key_search = $request->key_search ?? '';


        $this->v['key_search'] = $request->key_search ?? '';
//        $this->v['limit'] = $request->limit ?? 10;
//        $this->v['params'] = $request->all();

        $this->v['users']= User::join('products','users.id','=','products.vstore_id')
            ->leftJoin('order_item','products.id','=','order_item.product_id')
            ->leftJoin('order','order_item.order_id','=','order.id')
            ->select('users.id','users.name as name','users.phone_number','account_code','users.provinceId',DB::raw('COUNT(products.id) as countProduct'))
            ->selectSub('SELECT province_name from province WHERE province_id = users.provinceId','khu_vuc')
            ->groupBy('users.id')
            ->where('products.vstore_id',Auth::id())
            ->where('order.export_status',4);
            if ($this->v['key_search'] != ''){
                $this->v['users'] = $this->v['users']->where('account_code','like','%'.$this->v['key_search'].'%');
            };

        $this->v['users']=$this->v['users']->paginate(10);

//        return  $this->v['users'];
        return view('screens.vstore.partner.index', $this->v);

    }

    public function vshop(Request $request)
    {
        $limit = $request->limit ?? 10;
        $field = $request->field ?? 'products.id';
        $vshop = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vstore_id', Auth::id())
            ->select('vshop.id', 'vshop.pdone_id', 'vshop.nick_name', 'vshop.name as name', 'vshop.phone_number','vshop.vshop_id')
            ->groupBy('vshop.pdone_id');
        if ($request->key_search) {
            $vshop = $vshop->where($request->condition, 'like', '%' . trim($request->key_search) . '%');
        }
        $vshop = $vshop->paginate($limit);
        foreach ($vshop as $value) {

            $count = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
                ->join('products', 'vshop_products.product_id', '=', 'products.id')
                ->where('vshop.id', $value->id)
                ->where('products.vstore_id', Auth::id())
                ->count();

            $order_item = Order::join('order_item', 'order.id', '=', 'order_item.order_id')
                ->where('export_status',4)
                ->where('order.updated_at','<=',Carbon::now()->addDay(-7))
                ->where('vshop_id', $value->id)->sum('quantity') ?? 0;

            $money = 0;
            $order_tinh = Order::join('order_item', 'order.id', '=', 'order_item.order_id')
                ->where('export_status',4)
                ->where('order.updated_at','<=',Carbon::now()->addDay(-7))
                ->where('vshop_id', $value->id)->get();
            foreach ($order_tinh as $val){
                // lấy chiết khấu vshop trong product;
                $product_dis_vshop= Product::where('id',$val->product_id)->first()->discount_vShop??0;
//                return $val->discount_vshop;
                if ($product_dis_vshop !=0){
                    $money += (($val->price * $val->quantity) /100 * ($product_dis_vshop - $val->discount_vshop))/100*85;
                }else{
                    $money+=0;
                }
//                    (100000 /100 * (10 -1)) /100 * 85
            }
            $value->sum_sl = $order_item;
            if ($money <0){
                $money =0;
            }
            $value->thu_nhap = $money;
            $value->count = $count;

        }

        $count = count($vshop);
        $params = $request->all();
//        return $vshop;
        return view('screens.vstore.partner.vshop', compact('vshop', 'count', 'params','field'));

    }

    public function ship()
    {
        return view('screens.vstore.partner.ship', $this->v);

    }
    public function vshopDetail(Request $request){

        $vshop = Vshop::find($request->id);
        return $vshop;
        return view('screens.vstore.partner.vshop-detail',compact('vshop') );
    }
    public function detail(Request $request){
//        return $request;
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $key_search = $request->key_search ?? '';


        $this->v['key_search'] = $request->key_search ?? '';
//        $this->v['limit'] = $request->limit ?? 10;
//        $this->v['params'] = $request->all();

        $this->v['user']= User::join('products','users.id','=','products.vstore_id')
            ->leftJoin('order_item','products.id','=','order_item.product_id')
            ->leftJoin('order','order_item.order_id','=','order.id')
            ->select('users.name as name','users.phone_number','account_code','users.provinceId',DB::raw('COUNT(products.id) as countProduct'))
            ->selectSub('SELECT province_name from province WHERE province_id = users.provinceId','khu_vuc')
            ->groupBy('users.id')
            ->where('products.vstore_id',Auth::id())
            ->where('users.id',$request->id)
            ->first();
//            dd(1);
//        return  $this->v['users'];
        return view('screens.vstore.partner.detail', $this->v);
    }
}
