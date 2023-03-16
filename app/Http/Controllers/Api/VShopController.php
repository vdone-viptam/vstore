<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Lib9Pay\HMACSignature;
use App\Http\Lib9Pay\MessageBuilder;
use App\Models\BuyMoreDiscount;
use App\Models\Order;
use App\Models\PreOrderVshop;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @group Vshop
 *
 * Danh sách api liên quan V-shop
 */
class  VShopController extends Controller
{


    public function preOrderPayment(Request $request, $orderId) {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }

        $method = $request->method_payment;
        $user_id = $request->user_id;

        $order = PreOrderVshop::where('id', $orderId)
            ->where('user_id', $user_id)
            ->where('payment_deposit_money_status', 2)
            ->where('status', 2)
            ->first();


        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
        $returnUrl = $request->returnUrl ?? $http . config("domain.payment") . "/payment/pre-order/return";
        $backUrl = $request->backUrl ?? $http . config("domain.payment") . "/payment/pre-order/back";
//        date_default_timezone_set('UTC');
        $time = time();
        $invoiceNo = $order->no;
        $amount = $order->total;
        $merchantKey = config('payment9Pay.merchantKey');
        $merchantKeySecret = config('payment9Pay.merchantKeySecret');
        $merchantEndPoint = config('payment9Pay.merchantEndPoint');

        $data = array(
            'merchantKey' => $merchantKey,
            'time' => $time,
            'invoice_no' => $invoiceNo,
            'description' => 'Thanh toán đơn nhập hàng sẵn',
            'amount' => (float)$amount,
            'back_url' => $backUrl,
            'return_url' => $returnUrl,
            'method' => $method,
            'is_customer_pay_fee' => 1 // Đối tượng chịu phí. 0: người bán chịu phí, 1: khách hàng chịu phí
        );

        $message = MessageBuilder::instance()
            ->with($time, $merchantEndPoint . '/payments/create', 'POST')
            ->withParams($data)
            ->build();
        $hmacs = new HMACSignature();
        $signature = $hmacs->sign($message, $merchantKeySecret);
        $httpData = [
            'baseEncode' => base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE)),
            'signature' => $signature,
        ];

        try {
            $redirectUrl = $merchantEndPoint . '/portal?' . http_build_query($httpData);
            return response()->json([
                'redirectUrl'=>$redirectUrl,
                'time' => $time,
                'invoice_no' => $invoiceNo,
                'amount' => $amount,
                'back_url' => $backUrl,
                'return_url' => $returnUrl,
            ], 201);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                "message" => "500 Internal Server Error",
                "errors" => $e
            ], 500);
        }


    }
    public function preOrder(Request $request, $productId) {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
            'quantity' => 'required|numeric',
            'place_name' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'district_id' => 'required',
            'province_id' => 'required',
            'ware_id' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }

        $userId = $request->user_id;
        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wareId = $request->ware_id;

        $placeName = $request->place_name;
        $fullname = $request->fullname;
        $phone = $request->phone;
        $address = $request->address;

        $quantity = $request->quantity;

        $product = Product::where('id', $productId)
            ->where('status', config('constants.productStatus.activity'))
            ->select('price', 'name', 'vat', 'id', 'images')
            ->first();
        $product->images = json_decode($product->images);

        if(!$product) {
            return response()->json([
                "status_code" => 404,
                "message" => "Sản phẩm không tồn tại"
            ], 404);
        }

        $productBuyMoreDiscount = BuyMoreDiscount::where('product_id', $productId)
            ->orderBy('start', "ASC")
            ->get();

        $buyMoreDiscount = getDiscountAndDepositMoney($quantity, $productBuyMoreDiscount);
        $total = $product->price * $quantity;

        $order = new PreOrderVshop();
        $order->user_id = $userId;
        $order->district_id = $districtId;
        $order->province_id = $provinceId;
        $order->ware_id = $wareId;
        $order->product_id = $productId;
        $order->status = 2;
        $order->payment_status = 2;
        $order->payment_deposit_money_status = 2;
        $order->quantity = $quantity;
        $order->place_name = $placeName;
        $order->fullname = $fullname;
        $order->phone = $phone;
        $order->address = $address;

        $latestOrder = PreOrderVshop::orderBy('created_at','DESC')->first();
        $order->no = Str::random(5).str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);

        $order->total = $total;
        $order->discount = $buyMoreDiscount['discount'];
        $order->deposit_money = $buyMoreDiscount['deposit_money'];
        $order->save();

        $order->order_value_minus_discount = $order->total - $order->total*($order->discount/100);

        return response()->json([
            "order" => $order,
            "product" => $product
        ]);
    }


    /**
     * Tạo Vshop
     *
     * API để thêm 1 Vshop
     *
     * @bodyParam  pdone_id id của Vshop
     * @bodyParam  avatar url ảnh đại diện
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
            'avatar' => 'url',
            ' ' => 'string',
            'nick_name' => ''

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }
        $vshop = Vshop::where('pdone_id', $request->pdone_id)->first();
        if (!$vshop) {
            $vshop = new Vshop();

        }
        $vshop->pdone_id = $request->pdone_id;
        $vshop->avatar = $request->avatar ?? '';
        $vshop->nick_name = $request->nick_name;
        $vshop->save();
        return response()->json([
            'status_code' => 200,
            'message' => 'Tạo Vshop Thành công',
            'data' => $vshop
        ]);
    }

    /**
     * Danh sách Vshop
     *
     * API dùng để lấy danh sách Vshop
     *
     * @urlParam limit giới hạn bản ghi mặc ịnh là 10
     * @urlParam page số trang
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $vshop = Vshop::select('id', 'pdone_id', 'vshop_name as name', 'phone_number', 'products_sold', 'avatar', 'description', 'products_sold', 'address')->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'message' => 'Lấy thông tin thành công',
            'data' => $vshop
        ]);
    }

    public function getProductByIdPdone(Request $request)
    {
        $limit = $request->limit ?? 10;
        $pdone = Vshop::select('*')->join('products', 'vshop.id_product', '=', 'products.id')->where('pdone_id', $request->pdone_id)->orderBy('vshop.id', 'desc')->paginate($limit);

        return response()->json($pdone);
    }

    /**
     * danh sách chiết khấu cho hàng nhập sẵn
     *
     * API dùng để tính tỉ lệ chiết khấu cho nhập hàng sẵn
     *
     * @urlParam id id sản phẩm
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBuyMoreDiscount($id)
    {
        $buy_more = BuyMoreDiscount::select('start', 'discount', 'deposit_money')->where('product_id', $id)->get();
        return response()->json([
            'status_code' => 200,
            'data' => $buy_more,
        ]);
    }

    /**
     * Tỉ lệ chiết khấu mua nhiều giảm giá
     *
     * API dùng để tính tỉ lệ chiết khấu cho nhập hàng sẵn
     *
     * @urlParam id id sản phẩm
     * @urlParam total số lượng
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
            ->select('discount', 'deposit_money')
            ->first();
//        return $discount;
        if ($discount->discount == 0) {
            $discount = DB::table('buy_more_discount')->select('discount')
                ->where('end', 0)
                ->where('product_id', $request->id)
                ->select('discount', 'deposit_money')
                ->first();
        }
        return response()->json([
            'status_code' => 200,
            'discount' => $discount,
        ]);

    }

    /**
     * Thêm thông tin giao hàng Vshop
     *
     * API dùng thêm địa chỉ giao hàng của Vshop
     *
     * @param   pdone_id id của vshop
     * @bodyParam  name Tên người nhận
     * @bodyParam  address địa chỉ chi tiết
     * @bodyParam  phone_number Số điện thoại
     * @bodyParam  district quận,huyện
     * @bodyParam  province tỉnh thành
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAddressReceive(Request $request,$pdone_id)
    {
        $validator = Validator::make($request->all(), [
//            'pdone_id' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'district' => 'required|min:1',
            'province' => 'required|min:1'

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }

        try {


            DB::table('vshop')->insert([
                'pdone_id' => $pdone_id,
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'district' => $request->district,
                'province' => $request->province,
                'created_at' => Carbon::now()
            ]);

            return response()->json([
                'status_code' => 201,
                'message' => 'Thêm mới địa chỉ thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * thông tin địa chỉ giao hàng
     *
     * API Lấy ra thông tin địa chỉ giao hàng Vshop
     *
     * @param id id của Vshop
     * @return \Illuminate\Http\JsonResponse
     */
    public function editAddressReceive(Request $request, $id)
    {

        try {
            $address = DB::table('vshop')
                ->select('name','name_address','province','wards','district', 'address', 'phone_number',
                    'vshop.id','province.province_name','district.district_name','wards.wards_name')
                ->join('province','vshop.province','=','province.province_id')
                ->join('district','province.province_id','=','district.province_id')
                ->join('wards','district.district_id','=','wards.district_id')
                ->where('vshop.pdone_id', $id)->first();

            return response()->json([
                'status_code' => 200,
                'data' => $address,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ]);
        }

    }

    /**
     * Lưu mới mã giảm giá
     *
     * API này sẽ lưu mới mã giảm giá
     *
     * @param Request $request
     * @bodyParam pdone_id Mã p done required
     * @bodyParam product_id Mã sản phẩm required exits:products
     * @bodyParam start_date Ngày bắt đầu required date_format:Y/m/d after:Today
     * @bodyParam end_date Ngày kết thúc required date_format:Y/m/d after:start_date
     * @urlParam discount Phần trăm giảm giá required max:discount_vShop
     * @return \Illuminate\Http\JsonResponse
     */

    public function createDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date_format:Y/m/d|after:' . Carbon::now(),
            'end_date' => 'required|date_format:Y/m/d|after:start_date',
            "discount" => 'required|max:100'

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'error' => $validator->errors(),
            ]);
        }
        $discount = Product::select('discount_vShop')->where('id', $request->product_id)->where('status', 2)->first()->discount_vShop ?? 0;

        if (DB::table('discounts')->where('user_id', $request->pdone_id)->where('type', 3)->where('product_id', $request->product_id)->count() > 0) {
            return response()->json([
                'status_code' => 404,
                'error' => 'Mã giảm giá đã tồn tại',
            ]);
        }
        if ($discount == 0) {
            return response()->json([
                'status_code' => 400,
                'error' => 'Sản phẩm chưa niêm yết',
            ]);
        } elseif ($request->discount > $discount / 100 * 95) {
            return response()->json([
                'status_code' => 400,
                'error' => 'Phầm trăm giảm giá nhỏ hơn ' . $discount / 100 * 95,
            ]);
        } else {
            DB::table('discounts')->insert([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 3,
                'user_id' => $request->pdone_id
            ]);
            return response()->json([
                'status_code' => 201,
                'message' => 'Tạo mã giảm giá thành công'
            ]);
        }


    }

    /**
     * Sửa thông tin nhận hàng Vshop
     *
     * API này để sửa thông tin địa chỉ
     *
     * @param $id id Vshop
     * @param Request $request
     * @bodyParam name tên người nhận
     * @bodyParam address Địa chỉ cụ thể
     * @bodyParam phone_number Số điện thoại
     * @bodyParam district Quận huyện
     * @bodyParam province Tỉnh thành
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateAddressReceive(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:255',
            'name_address'=>'required',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'district' => 'required|min:1',
            'province' => 'required|min:1',
            'wards'=>'required|min:1'

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ],400);
        }
        try {
            $data = [
                'pdone_id' => $id,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'district' => $request->district,
                'province' => $request->province,
                'address' => $request->address,
                'wards'=>$request->wards,
                'name_address'=>$request-> name_address,
                'updated_at' => Carbon::now(),
            ];


            $model = DB::table('vshop')->where('pdone_id', $id)->update($data);
            return response()->json([
                'status_code' => 201,
                'data' => 'Cập nhật địa chỉ thành công',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Lấy thông tin cá nhân Vshop
     *
     * API này dùng để lấy thông tin cá nhân để dùng cho việc xem và chỉnh sửa
     *
     * @param $pdone_id pdone_id Vshop
     * @return \Illuminate\Http\JsonResponse
     */

    public function getProfile($pdone_id)
    {
        $vshop = Vshop::where('pdone_id', $pdone_id)
            ->select('id', 'pdone_id', 'avatar', 'vshop_name', 'description')
            ->first();
        if (!$vshop) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Không tìm thấy Vshop',
            ], 400);
        }
        return response()->json([
            'status_code' => 201,
            'data' => $vshop
        ], 200);
    }

    /**
     * Cập nhập thông tin Vshop
     *
     * API này dùng để cập nhập tin cá nhân
     *
     * @param $id id Vshop
     * @bodyParam avatar Ảnh đại diện
     * @bodyParam vshop_name Tên Vshop
     * @bodyParam description Mô tả
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'avatar' => 'required|max:255',
            'vshop_name' => 'required|max:255',
            'description' => 'required|max:255',

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }
        $vshop = Vshop::where('pdone_id', $id)->first();
        if (!$vshop) {
            $vshop = new Vshop();
        }
        $vshop->avatar = $request->avatar;
        $vshop->vshop_name = $request->vshop_name;
        $vshop->description = $request->description;
        $vshop->save();
        return response()->json([
            'status_code' => 201,
            'data' => $vshop
        ], 200);

    }

    /**
     * Cập nhập thông tin Vshop
     *
     * API này dùng để cập nhập tin cá nhân
     *
     * @param Request $request
     * @urlParam  id id vshop
     * @urlParam start_day lọc ngày bắt đầu
     * @urlParam  end_day lọc ngày kết thúc
     * @urlParam type 1 rút 2 cộng thêm, 3 hoàn tiền
     * @urlParam status 1 thành công, 2 thất bại, 3 đang xử lý
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_mony_history(Request $request)
    {
//        return $request->pdone_id;

        $limit = $request->limit ?? 10;

        $query = DB::table('balance_change_history')
            ->join('vshop', 'vshop.id', '=', 'balance_change_history.vshop_id')
            ->where('vshop.pdone_id', $request->pdone_id);

        if ($request->start_day) {
            $query = $query->whereDate('balance_change_history.created_at', '>=', $request->start_day);
        }
        if ($request->end_day) {
            $query = $query->whereDate('balance_change_history.created_at', '<=', $request->end_day);
        }
        if ($request->type) {
            $query = $query->where('balance_change_history.type', $request->type);
        }
        if ($request->status) {
            $query = $query->where('balance_change_history.status', $request->status);
        }
        $data = $query->select('balance_change_history.*', 'vshop.name as shopName')->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $data
        ], 200);

    }
}
