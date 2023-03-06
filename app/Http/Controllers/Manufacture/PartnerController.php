<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    //

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $products = Product::join('users', 'products.vstore_id', '=', 'users.id')
            ->where('products.user_id', Auth::id())
            ->where('products.status', 2)
            ->select('products.publish_id', 'products.name as name', 'products.price', 'users.name as user_name', 'products.discount', 'products.amount_product_sold')
            ->paginate($limit);
//        return $products;
        return view('screens.manufacture.partner.index', compact('products'));
    }

    public function report()
    {
        return view('screens.manufacture.partner.report', []);

    }
}
