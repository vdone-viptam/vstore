<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use const http\Client\Curl\AUTH_ANY;

class PartnerController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        // dd(Auth::id());
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['products'] = Product::join('users', 'products.vstore_id', '=', 'users.id')
            ->where('products.user_id', Auth::id())
            ->where('products.status', 2);
        $this->v['products'] = $this->v['products']
            ->select('users.name as vstore_name', 'users.account_code', 'users.phone_number', 'vstore_id', 'users.company_name', 'users.address',
                DB::raw('COUNT(products.id) as total_product'),
            )
            ->groupBy('vstore_name', 'users.account_code', 'users.phone_number')
            ->orderBy($this->v['field'], $this->v['type']);
        if (strlen($this->v['key_search']) > 0) {
            $this->v['products'] = $this->v['products']->where(function ($query) {
                $query->where('users.account_code', $this->v['key_search'])
                    ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('users.phone_number', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['products'] = $this->v['products']
            ->paginate( $this->v['limit']);

        $this->v['products']->map(function ($item) {
            $countCategory = Product::where('products.user_id', Auth::id())
                ->where('products.vstore_id', $item->vstore_id)
                ->where('products.status', 2)
                ->select(
                    DB::raw('COUNT(products.category_id) as total_category'),
                    'products.category_id'
                )->groupBy('category_id')
                ->get()->toArray();
            $item->total_category = count($countCategory);
            return $item;
        });
        if( $this->v['field'] == 'users.id'){
            if( $this->v['type'] == 'desc'){
                $sortedResult = $this->v['products']->getCollection()->sortByDesc('total_category')->values();
            }else{
                $sortedResult = $this->v['products']->getCollection()->sortBy('total_category')->values();
            }
            $this->v['products']->setCollection($sortedResult);
        }
        return view('screens.manufacture.partner.index', $this->v);
    }

    public function report()
    {
        return view('screens.manufacture.partner.report', []);

    }

    public function detail(Request $request)
    {

        $data = Order::join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id')
            ->where('order.export_status', 4)
            ->where('products.user_id', Auth::id())
            ->where('products.vstore_id', $request->vstore_id)
            ->where('products.status', 2)
            ->select('products.discount', 'order.total')
            ->get();
        $money = 0;
        foreach ($data as $key => $value) {
            $money = $value->discount * $value->total;
        };
        return response()->json([
            'money' => $money,
        ]);
    }
}
