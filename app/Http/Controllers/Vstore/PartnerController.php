<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
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
        $limit = $request->limit??10;
        $users = User::join('products','users.id','=','products.user_id')
            ->where('products.vstore_id',Auth::id())
            ->groupBy('users.id')
            ->select('users.id','users.account_code','users.name','users.phone_number');
        if ($request->key_search ){
            $users = $users->Where('users.account_code','like','%'.$request->key_search.'%')
            ->orWhere('users.name','like','%'.$request->key_search.'%')
            ->orWhere('users.phone_number','like','%'.$request->key_search.'%');
        }
        $users = $users->paginate($limit);

//
        foreach ($users as $val){
            $val->sl = Product::where('user_id',$val->id)->where('vstore_id',Auth::id())->count();
        }
//        return $users;
        $count = count($users);
        return view('screens.vstore.partner.index', compact('users','count'));

    }

    public function vshop(Request $request)
    {
        $limit = $request->limit ??10;
        $vshop= Vshop::join('vshop_products','vshop.id_pdone','=','vshop_products.id_pdone')
            ->join('products','vshop_products.product_id','=','products.id')
            ->where('vstore_id',Auth::id())
            ->select('vshop.id_pdone','vshop.name as name','vshop.phone_number')
            ->groupBy('vshop_products.id_pdone');
        if ($request->key_search){
            $vshop = $vshop->where('vshop.id_pdone','like','%'.$request->key_search.'%');
        }
        $vshop=$vshop->paginate($limit);
        foreach ($vshop as $value){
            $count = VshopProduct::where('id_pdone',$value->id_pdone)->count();
            $value->count =$count;
//            return $count;
        }

//         $vshop=$vshop;
        $count = count($vshop);
        return view('screens.vstore.partner.vshop',compact('vshop','count') );

    }

    public function ship()
    {
        return view('screens.vstore.partner.ship', $this->v);

    }
}
