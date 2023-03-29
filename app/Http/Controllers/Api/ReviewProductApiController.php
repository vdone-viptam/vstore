<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\API\ReviewProduct\ReviewProductRepositoryInterface;
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
    private ReviewProductRepositoryInterface $reviewProductRepository;
    public function __construct(ReviewProductRepositoryInterface $reviewProductRepository)
    {
        $this->reviewProductRepository = $reviewProductRepository;
    }
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
     * @param $product_id ID product
     * @bodyParam limit tổng số review / 1 trang
     * @bodyParam point_evaluation điểm đánh giá
     * @return \Illuminate\Http\JsonResponse
     */
    public function showListReviewProduct(Request $request,$product_id){
        try {
            $point_evaluation = $request->point_evaluation;
            $limit = $request->limit ?? 3;

            $totalReviews = Point::query()
                            ->where('product_id', $product_id)
                            ->select('customer_id', 'product_id', 'point_evaluation', 'created_at', 'updated_at','descriptions','images','id')
                            ->orderBy('updated_at', 'desc');
            if(!empty($point_evaluation)){
                $totalReviews = $totalReviews->where('point_evaluation',$point_evaluation);
            }
            $totalReviews = $totalReviews->paginate($limit);
            foreach($totalReviews as $key => $value){
                $calculatorFeeProductPoint = $this->reviewProductRepository->calculatorFeeProductPoint($value->product_id,$value->id);
                if(!empty($calculatorFeeProductPoint)){
                    $totalReviews[$key]['name_product'] = $calculatorFeeProductPoint['name_product'];
                    $totalReviews[$key]['count_product'] = $calculatorFeeProductPoint['count_product'];
                    $totalReviews[$key]['amount_to_pay'] = $calculatorFeeProductPoint['amount_to_pay'];
                    $totalReviews[$key]['price_product'] = $calculatorFeeProductPoint['price_product'];
                }
            }
            return response()->json([
                'success' => true,
                'data' => $totalReviews
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * xem danh sách đánh giá một sản phẩm
     *
     * API dùng xem danh sách đánh giá sản phẩm
     *
     * @param Request $request
     * @param $point_id ID points
     * @bodyParam customer_id ID customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function reviewDetailProduct(Request $request,$point_id){

        $validator = Validator::make($request->all(), [
            // 'point_id' => 'required|exists:points,id',
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
                $calculatorFeeProductPoint = $this->reviewProductRepository->calculatorFeeProductPoint($data->product_id,$data->id);
                if(!empty($calculatorFeeProductPoint)){
                    $data['name_product'] = $calculatorFeeProductPoint['name_product'];
                    $data['count_product'] = $calculatorFeeProductPoint['count_product'];
                    $data['amount_to_pay'] = $calculatorFeeProductPoint['amount_to_pay'];
                    $data['price_product'] = $calculatorFeeProductPoint['price_product'];
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
