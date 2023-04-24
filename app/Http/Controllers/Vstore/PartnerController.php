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
        $this->v['field'] = $request->field ?? 'countProduct';
        $this->v['type'] = $request->type ?? 'desc';
        $key_search = $request->key_search ?? '';


        $this->v['key_search'] = $request->key_search ?? '';
//        $this->v['limit'] = $request->limit ?? 10;
//        $this->v['params'] = $request->all();

        $this->v['users'] = User::join('products', 'users.id', '=', 'products.user_id')
            ->select('users.id', 'users.name as name', 'users.phone_number', 'account_code', 'users.provinceId', DB::raw('COUNT(products.id) as countProduct'))
            ->selectSub('SELECT province_name from province WHERE province_id = users.provinceId', 'khu_vuc')
            ->groupBy('users.id')
            ->where('products.vstore_id', Auth::id())
        ->orderBy($this->v['field'] ,$this->v['type']);
        if ($this->v['key_search'] != '') {
            $this->v['users'] = $this->v['users']->where('account_code', 'like', '%' . $this->v['key_search'] . '%')->orwhere('users.name', 'like', '%' . $this->v['key_search'] . '%');
        };

        $this->v['users'] = $this->v['users']->paginate(10);

//        return  $this->v['users'];
        return view('screens.vstore.partner.index', $this->v);

    }

    public function vshop(Request $request)
    {
        $limit = $request->limit ?? 10;
        $field = $request->field ?? 'products.id';
        $key_search = $request->key_search??'';
        $type = $request->type ?? 'desc';
        $vshop = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vstore_id', Auth::id())
            ->select('vshop.id', 'vshop.pdone_id', 'vshop.nick_name', 'vshop.name as name', 'vshop.phone_number', 'vshop.vshop_id')
            ->selectSub('SELECT SUM(order_item.price * quantity)   FROM `order` JOIN order_item on `order`.id = order_item.order_id JOIN products ON order_item.product_id = products.id WHERE export_status = 4 AND order_item.vshop_id = vshop.id AND products.vstore_id=' .Auth::id(),'doanh_thu')
            ->selectSub('SELECT SUM(order_item.price * quantity)  * (products.discount_vShop /100) FROM `order` JOIN order_item on `order`.id = order_item.order_id JOIN products ON order_item.product_id = products.id WHERE export_status = 4 AND order_item.vshop_id = vshop.id AND products.vstore_id=' .Auth::id(),'chiet_khau')
            ->selectSub('SELECT COUNT(vshop_products.id) FROM vshop JOIN vshop_products ON vshop.id = vshop_products.vshop_id JOIN products ON vshop_products.product_id = products.id WHERE vshop.id = vshop.id AND products.vstore_id = '.Auth::id(),'amount_product')
            ->selectSub('SELECT COUNT(`order`.id) from `order` JOIN order_item on `order`.id = order_item.order_id join products ON order_item.product_id = products.id  WHERE export_status = 4 AND vshop_id = vshop.id AND products.vstore_id = '.Auth::id(),'count_order')
            ->groupBy('vshop.pdone_id')
            ->orderBy($field,$type);
        if ($request->key_search) {
            $vshop = $vshop->where('vshop.nick_name', 'like', '%' . trim($request->key_search) . '%')
            ->orWhere('vshop.vshop_id', 'like', '%' . trim($request->key_search) . '%')
            ;
        }
        $vshop = $vshop->paginate($limit);
//        return $vshop;
        return view('screens.vstore.partner.vshop', compact('vshop',  'field','key_search','type'));

    }

    public function ship()
    {
        return view('screens.vstore.partner.ship', $this->v);

    }

    public function vshopDetail(Request $request)
    {

        $vshop = Vshop::find($request->id);
        return $vshop;
        return view('screens.vstore.partner.vshop-detail', compact('vshop'));
    }

    public function detail(Request $request)
    {
//        return $request;
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $key_search = $request->key_search ?? '';


        $this->v['key_search'] = $request->key_search ?? '';
//        $this->v['limit'] = $request->limit ?? 10;
//        $this->v['params'] = $request->all();

        $this->v['user'] = User::join('products', 'users.id', '=', 'products.user_id')
            ->select('users.name as name', 'users.phone_number', 'users.account_code', 'users.provinceId', DB::raw('COUNT(products.id) as countProduct'))
            ->selectSub('SELECT province_name from province WHERE province_id = users.provinceId', 'khu_vuc')
            ->groupBy('users.id')
            ->where('products.vstore_id', Auth::id())
            ->where('users.id', $request->id)
            ->first();

        return response()->json(['view' => view('screens.vstore.partner.detail', $this->v)->render()]);
    }
}
