<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BuyMoreDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
/**
 * @group Discount
 *
 * Danh sách api liên quan tới mã giảm giá
 */
class DiscountController extends Controller
{
    /**
     * Bill
     *
     * API dùng trả về % giảm giá dựa trên số lượng sản phẩm V-Shop lấy hàng sẵn
     *
     * @param Request $request
     * @bodyParam   id id sản phẩm
     * @bodyParam  total số lượng sản phẩm
     * @return JsonResponse
     */
    public function getDiscountByTotalProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
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

        $discount = DB::table('buy_more_discount')->select('discount')
            ->where('start', '<=', $request->total)
            ->where('end', '>', $request->total)
            ->where('product_id', $request->id)
            ->first()->discount ?? 0;
//        return $discount;
        if ($discount == 0) {
            $discount = DB::table('buy_more_discount')->select('discount')
                ->where('end', 0)
                ->where('product_id', $request->id )
                ->first()->discount;
        }
        return response()->json([
            'status_code' => 200,
            'discount' => $discount,
        ]);

    }
    /**
     * Bill
     *
     * API dùng trả về % giảm giá dựa trên số lượng sản phẩm
     *
     * @urlParam  id id sản phẩm
     * @return JsonResponse
     */
    public function availableDiscount($id){

        $discount = BuyMoreDiscount::where('product_id',$id)
            ->select('start','discount')
            ->get();
        return $discount;
    }
}
