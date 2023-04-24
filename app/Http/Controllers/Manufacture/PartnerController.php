<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
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
        $this->v['products'] = Product::join('users', 'products.vstore_id', '=', 'users.id')
            ->where('products.user_id', Auth::id())
            ->where('products.status', 2);
        if ($key_search && strlen(($key_search) > 0)) {
            $this->v['products'] = $this->v['products']->where(function ($sub) use ($key_search) {
                $sub->where('products.name', 'like', '%' . $key_search . '%')
                    ->orWhere('products.publish_id', 'like', '%' . $key_search . '%');
            });
        }
        $this->v['products'] = $this->v['products']->select('products.publish_id', 'products.name as name', 'products.price', 'users.name as vstore_name', 'products.discount', 'products.amount_product_sold')
            ->orderBy($this->v['field'], $this->v['type'])
            ->paginate($request->limit ?? 10);

        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();
        return view('screens.manufacture.partner.index', $this->v);
    }

    public function report()
    {
        return view('screens.manufacture.partner.report', []);

    }
}
