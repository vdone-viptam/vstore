<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
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
        if ($request->key_search && $request->condition ) {
            $users = $users->Where($request->condition, 'like', '%' . $request->key_search . '%');
        }
        $users = $users->paginate($limit);

//
        foreach ($users as $val) {
            $val->sl = Product::where('user_id', $val->id)->where('vstore_id', Auth::id())->count();
        }
//        return $users;
        $count = count($users);
        return view('screens.vstore.partner.index', compact('users', 'count'));

    }

    public function vshop(Request $request)
    {
        $limit = $request->limit ?? 10;
        $vshop = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vstore_id', Auth::id())
            ->select('vshop.id','vshop.pdone_id','vshop.nick_name', 'vshop.name as name', 'vshop.phone_number')
            ->groupBy('vshop.pdone_id');
        if ($request->key_search) {
            $vshop = $vshop->where('vshop.pdone_id', 'like', '%' . $request->key_search . '%');
        }
        $vshop=$vshop->paginate($limit);
        foreach ($vshop as $value){
//            $count = VshopProduct::where('pdone_id',$value->pdone_id)->count();

            $count= Vshop::join('vshop_products','vshop.id','=','vshop_products.vshop_id')
                ->join('products','vshop_products.product_id','=','products.id')
                ->where('vshop.id',$value->id)
                ->where('products.vstore_id',Auth::id())
                ->count();

            $order_item = Order::join('order_item','order.id','=','order_item.order_id')->where('vshop_id',$value->id)->sum('quantity')??0;
//            return $count;
            $value->sum_sl = $order_item;
            $value->count =$count;
//            return $count;
        }

//        return $vshop;
        $count = count($vshop);
        return view('screens.vstore.partner.vshop', compact('vshop', 'count'));

    }

    public function ship()
    {
        return view('screens.vstore.partner.ship', $this->v);

    }
}
