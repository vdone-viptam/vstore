<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VShopController extends Controller
{


    public function getProductByIdPdone(Request $request)
    {
        $limit = $request->limit ?? 10;
        $pdone = Vshop::select('*')->join('products', 'vshop.id_product', '=', 'products.id')->where('id_pdone', $request->id_pdone)->orderBy('vshop.id', 'desc')->paginate($limit);

        return response()->json($pdone);
    }

    public function getDiscountByTotalProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'publish_id' => 'required',
            'total' => 'required|numeric',

        ], [
            'publish_id.required' => 'Mã sản phẩm là bắt buộc',
            'total.required' => 'Số lượng sản phẩm nhập là bắt buộc',
            'total.numeric' => 'Số lượng sản phẩm phải là số'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }

        $discount = DB::table('buy_more_discount')->select('price')
                ->where('start', '<=', $request->total)
                ->where('end', '>', $request->total)
                ->where('product_id', $request->publish_id)
                ->first()->price ?? 0;

        if ($discount > 0) {
            $discount = DB::table('buy_more_discount')->select('price')
                ->where('end', 0)
                ->where('product_id', $request->publish_id)
                ->first()->price;
        }
        return response()->json([
            'status_code' => 200,
            'discount' => $discount,
        ]);

    }
}
