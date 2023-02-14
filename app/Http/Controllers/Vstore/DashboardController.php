<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $data = Product::select('products.images', 'name', 'product_id', 'requests.discount')->join('requests', 'products.id', '=', 'requests.product_id')->where('requests.status', 0)->groupBy(['products.images', 'name', 'product_id', 'requests.discount'])->limit(10)->get();

        return view('screens.vstore.dashboard.index', ['data' => $data]);

    }
}
