<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\API\ReviewProduct\ReviewProductRepositoryInterface;
use App\Interfaces\BigStore\CallApiRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Point;
use App\Models\PointRep;
use App\Models\Product;
use App\Models\Vshop;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;
/**
 * @group Review
 *
 * Danh sách api liên quan tới đánh giá sản phẩm
 */

class ReviewProductApiController extends Controller
{
    private ReviewProductRepositoryInterface $reviewProductRepository;
    private CallApiRepositoryInterface $callApiRepositoryInterface;
    public function __construct(
        ReviewProductRepositoryInterface $reviewProductRepository,
        CallApiRepositoryInterface $callApiRepositoryInterface
        )
    {
        $this->reviewProductRepository = $reviewProductRepository;
        $this->callApiRepositoryInterface = $callApiRepositoryInterface;
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
                // case đánh giá sản phẩm khi gửi request liên tục ?
                $checkExistPoint = Point::where('order_item_id',$request->order_item_id)
                                    ->where('product_id',$request->product_id)
                                    ->exists();
                if($checkExistPoint)
                    return response()->json([
                        'status_code' => 409,
                        'message' => 'Đã tồn tại đánh giá'
                    ], 409);
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
                    'status_code' => 201,
                    'message' => 'Đánh giá sản phẩm thành công'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
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
     * @param $product_id ID product
     * @bodyParam limit tổng số review / 1 trang
     * @bodyParam point_evaluation điểm đánh giá
     * @return \Illuminate\Http\JsonResponse
     */
    public function showListReviewProduct(Request $request,$product_id){
        try {
            $validator = Validator::make($request->all(), [
                'point_evaluation' => 'integer|between:1,5',
                'limit' => 'numeric|min:1',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }

            $point_evaluation = $request->point_evaluation;
            $limit = $request->limit ?? 3;

            $totalReviews = Point::query()
                            ->where('product_id', $product_id)
                            ->select('customer_id', 'product_id', 'point_evaluation', 'created_at', 'updated_at','descriptions','images','id',
                            DB::raw('round(AVG(point_evaluation),1) as rating_rate')
                            )
                            ->groupBy('customer_id', 'product_id', 'point_evaluation', 'created_at', 'updated_at','descriptions','images','id')
                            ->orderBy('updated_at', 'desc');
            if(isset($point_evaluation)){
                $totalReviews = $totalReviews->where('point_evaluation',$point_evaluation);
            }
            $totalReviews = $totalReviews->paginate($limit);

            foreach($totalReviews as $key => $value){
                $calculatorFeeProductPoint = $this->reviewProductRepository->calculatorFeeProductPoint($value->product_id,$value->id);
                $totalReviews[$key]['product'] = $calculatorFeeProductPoint;

                $totalReviews[$key]['customer'] = $this->callApiRepositoryInterface->callApiCustomerProfile($value->customer_id) ?? null;
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
     * xem danh sách đánh giá một sản phẩm trên Vdone
     *
     * API dùng xem danh sách đánh giá sản phẩm trên Vdone
     *
     * @param Request $request
     * @param $vdone_id vdone_id product
     * @bodyParam limit tổng số review / 1 trang
     * @bodyParam status_rep trạng thái trả lời của shop
     * @return \Illuminate\Http\JsonResponse
     */

     public function showListReviewVDone(Request $request,$vdone_id){
        try {
            $validator = Validator::make($request->all(), [
                'status_rep' => 'integer|between:0,1',
                'limit' => 'numeric|min:1',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }

            $status_rep = $request->status_rep;
            $limit = $request->limit ?? 3;

            $totalReviews = Point::query()
                            ->with(['pointRep'])
                            ->join('order_item','order_item.id','points.order_item_id')
                            ->join('vshop','order_item.vshop_id','vshop.id')
                            ->where('vshop.pdone_id', $vdone_id)
                            ->select(
                                'points.customer_id',
                                'points.product_id',
                                'points.point_evaluation',
                                'points.created_at',
                                'points.updated_at',
                                'points.descriptions',
                                'points.images',
                                'points.id',
                            DB::raw('round(AVG(point_evaluation),1) as rating_rate')
                            )
                            ->groupBy(
                                'points.customer_id',
                                'points.product_id',
                                'points.point_evaluation',
                                'points.created_at',
                                'points.updated_at',
                                'points.descriptions',
                                'points.images',
                                'points.id'
                            );
            if(isset($status_rep)){
                $totalReviews = $totalReviews->where('points.status',$status_rep);
            }
            $totalReviews = $totalReviews->orderBy('points.updated_at', 'desc')->paginate($limit);
            foreach($totalReviews as $key => $value){
                $calculatorFeeProductPoint = $this->reviewProductRepository->calculatorFeeProductPoint($value->product_id,$value->id);

                $totalReviews[$key]['product'] = $calculatorFeeProductPoint;
                $totalReviews[$key]['customer'] = $this->callApiRepositoryInterface->callApiCustomerProfile($value->customer_id) ?? null;
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
     * xem chi tiết đánh giá sản phẩm
     *
     * API dùng xem chi tiết đánh giá sản phẩm
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

                $data['product'] = $calculatorFeeProductPoint;
                $data['customer'] = $this->callApiRepositoryInterface->callApiCustomerProfile($data->customer_id) ?? null;
                return response()->json([
                    'success' => true,
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

    /**
     * rep đánh giá của khách
     *
     * API để shop rep đánh giá của khách
     *
     * @param Request $request
     * @bodyParam point_id ID point
     * @bodyParam descriptions nội dung
     * @return \Illuminate\Http\JsonResponse
     */
    public function repReviewProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'point_id' => 'required|exists:points,id',
            'descriptions' => 'required|max:200',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        try {
            // case khi gửi request liên tục ?
            $checkExistPointRep = PointRep::query()
                ->where('point_id',$request->point_id)
                ->exists();
            if($checkExistPointRep)
                return response()->json([
                    'status_code' => 409,
                    'message' => 'Đánh giá này đã được phản hồi'
                ], 409);
            $newPointRep = new PointRep();
            $newPointRep -> point_id = $request->point_id;
            $newPointRep -> descriptions = $request->descriptions;
            $newPointRep -> save();

            $point =  Point::find($request->point_id);
            $point -> status = 1;
            $point -> save();

            return response()->json([
                'status_code' => 201,
                'message' => 'Phản hồi đánh giá thành công'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * xem đánh giá tổng quan số sao của một sản phẩm
     *
     * API dùng xem tổng quan đánh giá sản phẩm dựa vào số sao
     *
     * @param $product_id ID product
     * @return \Illuminate\Http\JsonResponse
     */
    public function ratingRateProduct($product_id){
        try {
            $totalPoint = Point::where('product_id', $product_id)->get();
            if(count($totalPoint) == 0){
                return response()->json([
                    'status_code' => 404,
                    'error' => 'Sản phẩm chưa có đánh giá',
                ],404);
            }

            $arrPoint= [
                [
                    "key" => 1,
                    "name" => "one_point",
                    "count" => 0
                ],
                [
                    "key" => 2,
                    "name" => "two_point",
                    "count" => 0
                ],
                [
                    "key" => 3,
                    "name" => "three_point",
                    "count" => 0
                ],
                [
                    "key" => 4,
                    "name" => "four_point",
                    "count" => 0
                ],
                [
                    "key" => 5,
                    "name" => "five_point",
                    "count" => 0
                ]
            ];
            foreach ($arrPoint as $key => $value) {
                $arrPoint[$key]['count'] = $totalPoint->where('point_evaluation', $value['key'])->count();
            }
            $star = $totalPoint->avg('point_evaluation');
            $data = [];
            $data['rating_rate'] = round($star,1);
            $data ['data']= $arrPoint;
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
