<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Point;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Http;

class ReviewProductApiController extends Controller
{
    /**
     * lưu đánh giá sản phẩm
     *
     * @bodyParam product_id ID product
     * @bodyParam order_item_id ID order_item
     * @bodyParam customer_id ID customer
     * @bodyParam descriptions ghi chú
     * @bodyParam point_evaluation điểm đánh giá
     * @bodyParam images tối đa 3 ảnh
     * API dùng để lưu đánh giá sản phẩm sau khi hoàn thành mua hàng
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function acceptReviewProduct(Request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'order_item_id' => 'required|exists:order_item,id',
            'customer_id' => 'required',
            'descriptions' => 'required|max:200',
            'point_evaluation' => 'required|integer|between:1,5',
            "images" => ["array","max:3"],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        try {
            $checkExportStatus = Order::join('order_item','order_item.order_id','order.id')
                ->where('order_item.id',$request->order_item_id)
                ->where('order_item.product_id',$request->product_id)
                ->where('order.export_status',4)
                ->exists();
            if(!$checkExportStatus){
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Đơn hàng chưa giao thành công, không thể đánh giá'
                ], 500);
            }else{
                $newPoint = new Point();
                $newPoint -> customer_id = $request->customer_id;
                $newPoint -> product_id = $request->product_id;
                $newPoint -> point_evaluation = $request->point_evaluation;
                $newPoint -> order_item_id = $request->order_item_id;
                $newPoint -> descriptions = $request->descriptions;
                if(!empty($request->images))
                    $newPoint -> images = json_encode($request->images);
                $newPoint -> save();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Đánh giá sản phẩm thành công'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * xem chi tiết đánh giá sản phẩm
     *
     * API dùng xem chi tiết đánh giá sản phẩm
     *
     * @param Request $request
     * @param $point_id ID points
     * @bodyParam order_item_id ID order_item
     * @bodyParam customer_id ID customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function reviewDetailProduct(Request $request,$point_id){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'point_id' => 'required|exists:points,id',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        try {
            $data = Point::query()
                ->where('points.id',$point_id)
                ->where('points.customer_id',$request->customer_id)
                ->first();
            if(!($data)){
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Không tìm thấy đánh giá !'
                ], 500);
            }else{
                $productId = $data -> product_id;
                $product = Product::where('id',$productId)->first();
                if($product){
                    $data['name_product'] = $product->name;
                    $orderItem = OrderItem::join('points','points.order_item_id','order_item.id')
                        ->join('order','order.id','order_item.order_id')
                        ->where('points.id',$request->point_id)
                        ->select(
                            'order_item.quantity',
                            'discount_vshop',
                            'discount_ncc',
                            'discount_vstore',
                            'order_item.price',
                            'order.shipping'
                        )
                        ->first();
                    $data['count_product'] = $orderItem->quantity;

                    // a = ( giá sp * sl) - giảm giá
                    //  b = a *vat (tính vat)
                    // số tiền thực tế phải đóng = a + b + phí ship
                    $totalDiscount = ($orderItem->discount_vshop + $orderItem->discount_ncc + $orderItem->discount_vstore );
                    if( $totalDiscount  > 0 ){
                        $totalDiscount = $totalDiscount /100;
                    }
                    $totalProduct = $orderItem->price * $orderItem->quantity;
                    $shipping = $orderItem->shipping;
                    $totalVat = $product->vat;
                    if( $totalVat  > 0 ){
                        $totalVat = $totalVat / 100 ;
                    }
                    $amount_to_pay = $totalProduct  -  (  $totalProduct * $totalDiscount );
                    $amount_to_pay = $amount_to_pay + $amount_to_pay* $totalVat + $shipping;
                    $data['amount_to_pay'] = $amount_to_pay;
                    $data['price_product'] = $totalProduct;
                }
                return response()->json([
                    'status_code' => 200,
                    'data' => $data
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
