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
        $limit = $request->limit ?? 10;
        $users = User::join('products', 'users.id', '=', 'products.user_id')
            ->where('products.vstore_id', Auth::id())
            ->groupBy('users.id')
            ->select('users.id', 'users.account_code', 'users.name', 'users.phone_number');
        if ($request->key_search && $request->condition) {
            $users = $users->Where($request->condition, 'like', '%' . $request->key_search . '%');
        }
        $users = $users->paginate($limit);

//
        foreach ($users as $val) {
            $val->sl = Product::where('user_id', $val->id)->where('vstore_id', Auth::id())->count();
        }
        $count = count($users);
        return view('screens.vstore.partner.index', compact('users', 'count'));

    }

    public function vshop(Request $request)
    {
        $limit = $request->limit ?? 10;
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
        return view('screens.vstore.partner.vshop', compact('vshop', 'count', 'params'));

    }

    public function ship()
    {
        return view('screens.vstore.partner.ship', $this->v);

    }
    public function vshopDetail(Request $request){

        $vshop = Vshop::find($request->id);

        return view('screens.vstore.partner.vshop-detail',compact('vshop') );
    }
}
