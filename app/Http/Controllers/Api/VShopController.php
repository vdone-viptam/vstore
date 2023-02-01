<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vshop;
use Illuminate\Http\Request;

class VShopController extends Controller
{
    //

    public function getProductByIdPdone(Request $request)
    {
        $limit = $request->limit ?? 10;
        $pdone = Vshop::select('*')->join('products', 'vshop.id_product', '=', 'products.id')->where('id_pdone', $request->id_pdone)->order('vshop.id', 'desc')->pagiante($limit);

        return response()->json($pdone);
    }

}
