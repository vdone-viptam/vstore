<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $data = Product::select('products.images', 'name', 'product_id', 'requests.discount')->join('requests', 'products.id', '=', 'requests.product_id')->where('requests.status', 0)->groupBy(['products.images', 'name', 'product_id', 'requests.discount'])
            ->where('products.vstore_id',Auth::id())
            ->limit(10)->get();
//        $vshop = Vshop::where('id_npp',Auth::id())->groupBy('pdone_id')->paginate(5);
                $vshop  = [];
//        return $vshop;
        return view('screens.vstore.dashboard.index', ['data' => $data, 'vshop' => $vshop]);

    }
}
