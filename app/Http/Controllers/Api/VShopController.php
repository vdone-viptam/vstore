<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Lib9Pay\HMACSignature;
use App\Http\Lib9Pay\MessageBuilder;
use App\Models\BuyMoreDiscount;
use App\Models\Category;
use App\Models\Discount;
use App\Models\District;
use App\Models\Order;
use App\Models\PreOrderVshop;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Models\Ward;
use App\Notifications\AppNotification;
use Elastic\Elasticsearch\Exception\ClientResponseException;
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
    public function searchShopByKeyword(Request $request)
    {
        $limit = $request->limit ?? 12;
        $elasticsearchController = new ElasticsearchController();
        $res = $elasticsearchController->searchDocVShop($request->key_word);
        $validator = Validator::make($request->all(), [
            'key_word' => 'required'
        ],
            [
                'key_word.required' => 'Từ khóa tìm kiếm không được để trông'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        $user = Vshop::whereIn('id', $res)
            ->select('pdone_id as id', 'nick_name', 'avatar');

        $user = $user->where('nick_name', '!=', null)->paginate($limit);
        if ($user) {
            foreach ($user as $value) {
                if ($value->avatar == "") {
                    $value->avatar = asset('home/img/logo-06.png');
                } else
                    $value->avatar = $value->avatar;

            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,
        ]);
    }

    public function updateStatusDonePreOrder(Request $request, $orderID)
    {
//        return 1;
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $preOrder = PreOrderVshop::where('id', $orderID)
            ->where('user_id', $request->user_id)
            ->where('status', config('constants.statusPreOrder.shipping'))->first();

        if (!$preOrder) {
            return response()->json([
                "status_code" => 404,
                "message" => "Đơn đặt hàng không tồn tại"
            ]);
        }

        $preOrder->status = config('constants.statusPreOrder.done');
        $preOrder->save();

        $vshop = Vshop::select('id')->where('pdone_id', $request->user_id)->first();
//        return $preOrder->product_id;
        if ($vshop) {
            $vshop_product = VshopProduct::where('vshop_id', $vshop->id)->where('product_id', $preOrder->product_id)->first();
//            return $vshop_product;
            if ($vshop_product) {
                $vshop_product->status = 2;
                $vshop_product->amount += $preOrder->quantity;
                $vshop_product->save();
            } else {
                $vshop_product = new VshopProduct();
                $vshop_product->vshop_id = $vshop->id;
                $vshop_product->status = 2;
                $vshop_product->amount += $preOrder->quantity;
                $vshop_product->product_id = $preOrder->product_id;
                $vshop_product->save();
            }

        }

        return response()->json([
            "status_code" => 200,
            "message" => "Xác nhận đơn hàng thành công"
        ]);

    }

    public function getPreOrder(Request $request, $userId)
    {

        $limit = $request->limit ?? 2;

        $preOrder = PreOrderVshop::where('pre_order_vshop.user_id', $userId);
        if ($request->status) {
            $preOrder = $preOrder->where('pre_order_vshop.status', $request->status);
        }
        $preOrder = $preOrder->join('products', 'products.id', '=', 'pre_order_vshop.product_id')
            ->join('province', 'province.id', '=', 'pre_order_vshop.province_id')
            ->join('district', 'district.id', '=', 'pre_order_vshop.district_id')
            ->join('wards', 'wards.id', '=', 'pre_order_vshop.ward_id')
            ->select(
                "pre_order_vshop.id",
                "pre_order_vshop.no",
                "pre_order_vshop.quantity",
                "pre_order_vshop.place_name",
                "pre_order_vshop.fullname",
                "pre_order_vshop.phone",
                "pre_order_vshop.address",
                "pre_order_vshop.discount",
                "pre_order_vshop.deposit_money",
                "pre_order_vshop.total",
                "pre_order_vshop.no",
                "pre_order_vshop.status",
                "pre_order_vshop.created_at",
                "products.id as product_id",
                "products.images",
                "products.name",
                "products.price",
                "products.vat",
                "products.publish_id",
                "province.province_name",
                "district.district_name",
                "wards.wards_name"
            )
            ->orderBy('pre_order_vshop.created_at', 'desc')
            ->distinct()
            ->simplePaginate($limit);

        foreach ($preOrder as $value) {
            $value->prepayment_rate = $value->deposit_money;
            $value->order_value_minus_discount = $value->total - $value->total * ($value->discount / 100);
            $value->deposit_payable = $value->order_value_minus_discount - ($value->order_value_minus_discount * ($value->deposit_money / 100));

            $value->status_text = statusPreOrder($value->status);

            $value->receiver_information = [
                "fullname" => $value->fullname,
                "phone" => $value->phone,
                "address" => $value->address,
                "province_name" => $value->province_name,
                "district_name" => $value->district_name,
                "wards_name" => $value->wards_name,
                "place_name" => $value->place_name,
            ];
            $value->product = [
                "id" => $value->product_id,
                "name" => $value->name,
                "images" => json_decode($value->images),
                "price" => $value->price,
                "vat" => $value->vat,
                "publish_id" => $value->publish_id
            ];

            unset($value->name);
            unset($value->images);
            unset($value->price);
            unset($value->vat);

            unset($value->place_name);
            unset($value->fullname);
            unset($value->phone);
            unset($value->address);
            unset($value->province_name);
            unset($value->district_name);
            unset($value->wards_name);

        }

        return response()->json([
            "status_code" => 200,
            "order" => $preOrder
        ]);

    }


    public function preOrderConfirm(Request $request, $orderId)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $user_id = $request->user_id;

        $order = PreOrderVshop::where('id', $orderId)
            ->where('user_id', $user_id)
            ->where('payment_deposit_money_status', 2)
            ->where('status', config('constants.statusPreOrder.new_oder'))
            ->first();

        if (!$order) {
            return response()->json([
                "status_code" => 404,
                "message" => "Hoá đơn không tồn tại"
            ], 404);
        }

        $order->status = config('constants.statusPreOrder.user_confirm');;
        $order->save();


        $order->prepayment_rate = $order->deposit_money;
        $order->order_value_minus_discount = $order->total - $order->total * ($order->discount / 100);
        $order->deposit_payable = $order->total - $order->total * ($order->deposit_money / 100);


        $checkNewVshopProduct = VshopProduct::where('vshop_id', $user_id)
            ->where('status', '!=', 3)
            ->where('product_id', $order->product_id)
            ->first();

        if ($checkNewVshopProduct) {
            $checkNewVshopProduct->product_id = $order->product_id;
            if ($checkNewVshopProduct->status == 1) {
                $checkNewVshopProduct->status = 2;
            }

            $checkNewVshopProduct->amount += $order->quantity;
            $checkNewVshopProduct->save();
        } else {
            $newVshopProduct = new VshopProduct();
            $newVshopProduct->vshop_id = $user_id;
            $newVshopProduct->product_id = $order->product_id;
            $newVshopProduct->amount = $order->quantity;
            $newVshopProduct->status = 2;
            $newVshopProduct->save();

        }


        return response()->json([
            "status_code" => 200,
            "order" => $order
        ]);

    }

    public function preOrderPayment(Request $request, $orderId)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $method = $request->method_payment;
        $user_id = $request->user_id;

        $order = PreOrderVshop::where('id', $orderId)
            ->where('user_id', $user_id)
            ->where('payment_deposit_money_status', 2)
            ->where('status', 2)
            ->first();

        if (!$order) {
            return response()->json([
                "status_code" => 404,
                "message" => "Hoá đơn không tồn tại"
            ]);
        }

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
                'redirectUrl' => $redirectUrl,
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

    public function preOrder(Request $request, $productId)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'ncc_id' => 'required',
            'is_pdone' => 'required|boolean',
            'quantity' => 'required|numeric',
            'place_name' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'district_id' => 'required',
            'province_id' => 'required',
            'ward_id' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        $nccId = $request->ncc_id;
        $ncc = User::where('id', $nccId)
            ->where('status', 1)
            ->where('role_id', 2)->first();
        if (!$ncc) {
            return response()->json([
                "status_code" => 404,
                "message" => "Nhà cung cấp không tồn tại"
            ], 404);
        }

        $userId = $request->user_id;
        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wareId = $request->ward_id;

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

        if (!$product) {
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
        $order->ward_id = $wareId;
        $order->product_id = $productId;
        $order->status = config('constants.statusPreOrder.new_oder');
        $order->payment_status = 2;
        $order->payment_deposit_money_status = 2;
        $order->quantity = $quantity;
        $order->place_name = $placeName;
        $order->fullname = $fullname;
        $order->phone = $phone;
        $order->address = $address;
        $order->ncc_id = $ncc->id;

        $latestOrder = PreOrderVshop::orderBy('created_at', 'DESC')->first();
        $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);

        $order->total = $total;
        $order->discount = $buyMoreDiscount['discount'];
        $order->deposit_money = $buyMoreDiscount['deposit_money'];
        $order->save();
        $order->prepayment_rate = $buyMoreDiscount['deposit_money'];

        $order->order_value_minus_discount = $order->total - $order->total * ($order->discount / 100);
        $order->deposit_payable = $order->total - $order->total * ($buyMoreDiscount['deposit_money'] / 100);
        $user = User::find($ncc->id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo

        $data = [
            'title' => 'Bạn vừa có 1 thông báo mới',
            'avatar' => asset('image/users' . $user->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
            'message' => 'Bạn vừa có đơn hàng nhập sẵn mới ',
            'created_at' => \Carbon\Carbon::now()->format('h:i A d / m / Y'),
            'href' => route('screens.manufacture.order.request', ['key_search' => $order->no])
        ];
        $user->notify(new AppNotification($data));
        return response()->json([
            "order" => $order,
            "product" => $product
        ], 200);
    }


    /**
     * Tạo Vshop
     *
     * API để thêm 1 Vshop
     *
     * @bodyParam  pdone_id id của Vshop
     * @bodyParam vshop_id mã user dạng string
     * @bodyParam  avatar url ảnh đại diện có thể rỗng
     * @bodyParam nick_name nick_name của vshop
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
            'vshop_id' => 'required|string',
            'nick_name' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        DB::beginTransaction();
        $vshop = Vshop::where('pdone_id', $request->pdone_id)->first();
        $elasticsearchController = new ElasticsearchController();
        if (!$vshop) {
            $vshop = new Vshop();

        } else {
            try {
                $vshop->pdone_id = $request->pdone_id;
                $vshop->avatar = $request->avatar ?? '';
                $vshop->nick_name = $request->nick_name;
                $vshop->vshop_id = $request->vshop_id;
                $vshop->vshop_name = $request->nick_name;
                $vshop->save();
                $res = $elasticsearchController->searchDocVShop($request->nick_name);
                if (count($res) == 0 || !in_array($vshop->id, $res)) {
                    $res = $elasticsearchController->createDocVShop((string)$vshop->id, $request->nick_name);
                } else {
                    $res = $elasticsearchController->updateDocVShop((string)$vshop->id, $request->nick_name);
                }
                DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Cập nhật Thành công',
                    'data' => $vshop
                ], 200);
            } catch (ClientResponseException $exception) {
                DB::rollBack();
                return response()->json(['message' => $exception->getMessage()], 500);
            }
        }
        $vshop->pdone_id = $request->pdone_id;
        $vshop->avatar = $request->avatar ?? '';
        $vshop->nick_name = $request->nick_name;
        $vshop->vshop_id = $request->vshop_id;
        $vshop->vshop_name = $request->nick_name;
        $vshop->save();
        try {
            $res = $elasticsearchController->createDocVShop((string)$vshop->id, $request->nick_name);
            DB::commit();
        } catch (ClientResponseException $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
        }
        return response()->json([
            'status_code' => 200,
            'message' => 'Tạo Vshop Thành công',
            'data' => $vshop
        ], 200);
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
        $vshop = Vshop::select('id', 'pdone_id', 'phone_number', 'vshop_name as name', 'products_sold', 'avatar', 'description', 'products_sold', 'address', 'vshop_id', 'nick_name')->where('nick_name', '!=', null)->paginate($limit);
        foreach ($vshop as $val) {
            if ($val->avatar == null) {
                $val->avatar = asset('home/img/vshop-vuong.png');
            }
        }
        return response()->json([
            'status_code' => 200,
            'message' => 'Lấy thông tin thành công',
            'data' => $vshop
        ], 200);
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
        ], 200);
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
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
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
        ], 200);

    }

    /**
     * Thêm thông tin giao hàng Vshop
     *
     * API dùng thêm địa chỉ giao hàng của Vshop
     *
     * @param pdone_id id của vshop
     * @bodyParam  name Tên người nhận
     * @bodyParam  address địa chỉ chi tiết
     * @bodyParam  phone_number Số điện thoại
     * @bodyParam  district quận,huyện
     * @bodyParam  province tỉnh thành
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAddressReceive(Request $request, $pdone_id)
    {

        $validator = Validator::make($request->all(), [
//            'pdone_id' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'district' => 'required|min:1',
            'province' => 'required|min:1',
            'wards' => 'required|min:1'

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        try {
            $vshop = Vshop::where('pdone_id', $request->pdone_id)->first();
            $province_name = Province::where('province_id', $request->province)->first()->province_name;
            $district_name = District::where('district_id', $request->district)->first()->district_name;
            $wards_name = Ward::where('wards_id', $request->wards)->first()->wards_name;
            $address = $wards_name . ',' . $district_name . ', ' . $province_name;
            $result = getLatLongByAddress($address);
            if (!$result) {
                return response()->json([
                    'status_code' => 400,
                    'message' => 'Địa chỉ không hợp lệ',
                ], 400);
            }

            $lat = $result['lat'];
            $long = $result['lng'];
            if (!$vshop) {

                DB::table('vshop')->insert([
                    'name_address' => $request->name_address,
                    'pdone_id' => $pdone_id,
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'district' => $request->district,
                    'province' => $request->province,
                    'wards' => $request->wards,
                    'created_at' => Carbon::now(),
                    'lat' => $lat,
                    'long' => $long
                ]);
            } else {
                $vshop->name = $request->name;
                $vshop->address = $request->address;
                $vshop->phone_number = $request->phone_number;
                $vshop->district = $request->district;
                $vshop->province = $request->province;
                $vshop->name_address = $request->name_address;
                $vshop->wards = $request->wards;
                if ($lat && $long) {
                    $vshop->lat = $lat;
                    $vshop->long = $long;
                }
                $vshop->save();

            }


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
                ->select('name', 'name_address', 'province', 'wards', 'district', 'address', 'phone_number',
                    'vshop.id')
                ->where('vshop.pdone_id', $id)->first();
            $address->province_name = Province::where('province_id', $address->province)->first()->province_name;
            $address->district_name = District::where('district_id', $address->district)->first()->district_name;
            $address->wards_name = Ward::where('wards_id', $address->wards)->first()->wards_name;
            return response()->json([
                'status_code' => 200,
                'data' => $address,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }

    }

    /**
     * lấy mã giảm giá theo vshop và sản phẩm
     *
     * API này lấy chi tiết mã giảm giá theo pdone_id,product_id
     *
     * @param Request $request
     * @param pdone_id Mã p done required
     * @param product_id Mã sản phẩm required exits:products
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDiscount(Request $request, $pdone_id, $product_id)
    {


        $discount = Discount::where('user_id', $pdone_id)->where('product_id', $product_id)->where('type', 3)->first();
        if (!$discount) {
            return response()->json([
                'status_code' => 404,
                'error' => 'Mã giảm giá không tồn tại',
            ], 404);
        } else {
            return response()->json([
                'status_code' => 200,
                'data' => $discount,
            ]);
        }
//        return $pdone_id. $product_id;
    }

    /**
     * thay dổi thông tin mã giảm giá theo vshop và sản phẩm
     *
     * API này lấy chi tiết mã giảm giá theo pdone_id,product_id
     *
     * @param Request $request
     * @param pdone_id Mã p done required
     * @param product_id Mã sản phẩm required exits:products
     * @bodyParam start_date Ngày bắt đầu required date_format:Y/m/d after:Today
     * @bodyParam end_date Ngày kết thúc required date_format:Y/m/d after:start_date
     * @urlParam discount Phần trăm giảm giá required min:0 max:discount_vShop
     * @return \Illuminate\Http\JsonResponse
     */
    public function editDiscount(Request $request, $pdone_id, $product_id)
    {
//        return 1;
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y/m/d H:i|after:' . Carbon::now()->addMinutes(9),
            'end_date' => 'required|date_format:Y/m/d H:i|after:start_date',
            "discount" => 'required|min:0|max:100'

        ], [
            'start_date.after' => 'Thời gian bắt đầu giảm giá phải sau thời gian hiên tại 10 phút',
            'end_date.after' => 'Thời điểm kết thúc giảm giá phải sau thời điểm bắt đầu'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'error' => $validator->errors(),
            ], 400);
        }
        $to = Carbon::make($request->start_date);
        $from = Carbon::make($request->end_date);
        if ($from->diffInMinutes($to) <= 9) {
            return response()->json([
                'status_code' => 400,
                'error' => [
                    'end_date' => 'Thời gian kết thúc phải sau thời gian bắt đầu 10 phút'
                ],
            ], 400);
        }

        $discount = Discount::where('user_id', $pdone_id)->where('product_id', $product_id)->where('type', 3)->first();
        $product = Product::find($product_id);

        if (!$discount) {
            return response()->json([
                'status_code' => 404,
                'error' => 'Mã giảm giá không tồn tại',
            ], 404);

        } else {

            $discount_vshop = Product::select('discount_vShop')->where('id', $product_id)->where('status', 2)->first()->discount_vShop ?? 0;
            if ($discount_vshop == 0) {
                return response()->json([
                    'status_code' => 400,
                    'error' => 'Sản phẩm chưa niêm yết',
                ], 400);
            } elseif ($request->discount > ($discount_vshop * 0.95)) {
//                return  $discount ;
                return response()->json([
                    'status_code' => 400,
                    'error' => 'Phầm trăm giảm giá nhỏ hơn hoặc bằng ' . round(($discount_vshop * 0.95), 1),
                    'discount_limit' => round(($discount_vshop * 0.95), 1),
                    'discount_price_limit' => round(($product->price / 100) * ($discount_vshop * 0.95), 1)
                ], 400);

            } else {

                $discount->start_date = $request->start_date;
                $discount->end_date = $request->end_date;
                $discount->discount = $request->discount;
                $discount->save();

//            return $discount;
                return response()->json([
                    'status_code' => 201,
                    'message' => 'Chỉnh sửa mã giảm giá thành công'
                ]);
            }
            return response()->json([
                'status_code' => 200,
                'data' => $discount,
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
     * @urlParam discount Phần trăm giảm giá required min:0 max:discount_vShop
     * @return \Illuminate\Http\JsonResponse
     */

    public function createDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date_format:Y/m/d H:i|after:' . Carbon::now()->addMinutes(9),
            'end_date' => 'required|date_format:Y/m/d H:i|after:start_date',
            "discount" => 'required|min:0|max:100'

        ], [
            'start_date.after' => 'Thời gian bắt đầu giảm giá phải sau thời gian hiên tại 10 phút',
            'end_date.after' => 'Thời điểm kết thúc giảm giá phải sau thời điểm bắt đầu'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'error' => $validator->errors(),
            ], 400);
        }
        $to = Carbon::make($request->start_date);
        $from = Carbon::make($request->end_date);
        if ($from->diffInMinutes($to) <= 9) {
            return response()->json([
                'status_code' => 400,
                'error' => [
                    'end_date' => 'Thời gian kết thúc phải sau thời gian bắt đầu 10 phút'
                ],
            ], 400);
        }
        $discount = Product::select('discount_vShop')->where('id', $request->product_id)->where('status', 2)->first()->discount_vShop ?? 0;
        $product = Product::find($request->product_id);
        if (DB::table('discounts')->where('user_id', $request->pdone_id)->where('type', 3)->where('product_id', $request->product_id)->count() > 0) {
            return response()->json([
                'status_code' => 400,
                'error' => 'Mã giảm giá đã tồn tại',
            ], 400);
        }
        if ($discount == 0) {
            return response()->json([
                'status_code' => 400,
                'error' => 'Sản phẩm chưa niêm yết',
            ], 400);
        } elseif ($request->discount > $discount * 0.95) {
            return response()->json([
                'status_code' => 400,
                'error' => 'Phần trăm giảm giá nhỏ hơn hoặc bằng ' . round($discount * 0.95, 1),
                'discount_limit' => round($discount * 0.95, 1),
                'discount_price_limit' => round(($product->price / 100) * ($discount * 0.95), 1)
            ], 400);
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
            'name_address' => 'required',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'district' => 'required|min:1',
            'province' => 'required|min:1',
            'wards' => 'required|min:1'

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        try {
            $data = [
                'pdone_id' => $id,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'district' => $request->district,
                'province' => $request->province,
                'address' => $request->address,
                'wards' => $request->wards,
                'name_address' => $request->name_address,
                'updated_at' => Carbon::now(),
            ];
            $province_name = Province::where('province_id', $request->province)->first()->province_name;
            $district_name = District::where('district_id', $request->district)->first()->district_name;
            $wards_name = Ward::where('wards_id', $request->wards)->first()->wards_name;
            $address = $wards_name . ',' . $district_name . ', ' . $province_name;
            $result = getLatLongByAddress($address);
            if (!$result) {
                return response()->json([
                    'status_code' => 400,
                    'message' => 'Địa chỉ không hợp lệ',
                ], 400);
            }

            $lat = $result['lat'];
            $long = $result['lng'];
            if ($lat && $long) {
                $data['lat'] = $lat;
                $data['long'] = $long;
            }
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
            ->select('id', 'pdone_id', 'avatar', 'vshop_name', 'nick_name', 'description', 'vshop_id')
            ->first();
        $total_product = VshopProduct::where('vshop_id', $vshop->id)->whereIn('status', [1, 2])->count();
        if (!$vshop) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Không tìm thấy Vshop',
            ], 400);
        }
        if ($vshop->avatar == "") {
            $vshop->avatar = $vshop->avatar = asset('home/img/vshop-vuong.png');
        }
        $vshop->total_product = $total_product;
        $cate = Category::select('categories.name')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('vshop_products', 'products.id', '=', 'vshop_products.product_id')
            ->join('vshop', 'vshop_products.vshop_id', '=', 'vshop.id')
            ->where('vshop.pdone_id', $vshop->pdone_id)
            ->whereIn('vshop_products.status', [1, 2])
            ->groupBy('categories.name')
            ->get();
        if ($cate) {
            $data = [];
            foreach ($cate as $c) {
                $data[] = $c->name;
            }
            if (count($data) > 0) {
                $vshop->categories = implode(', ', $data) ?? '';
            } else {
                $vshop->categories = '';
            }
        } else {
            $vshop->categories = '';
        }


        return response()->json([
            'status_code' => 201,
            'data' => $vshop
        ], 200);
    }

    /**
     * Cập nhật thông tin Vshop
     *
     * API này dùng để cập nhật tin cá nhân
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
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        $vshop = Vshop::where('pdone_id', $id)->first();
        if (!$vshop) {
            $vshop = new Vshop();
        }
        $vshop->avatar = $request->avatar;
        $vshop->vshop_name = $request->vshop_name;
        $vshop->description = $request->description;
        if ($request->nick_name) {
            $vshop->nick_name = $request->nick_name;
        }
        $vshop->save();
        return response()->json([
            'status_code' => 201,
            'data' => $vshop
        ], 200);

    }

    /**
     * Cập nhật thông tin Vshop
     *
     * API này dùng để cập nhật tin cá nhân
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

    public function adminGetProductByvShop(Request $request, $pdone_id)
    {
        try {
            $products = [];
            $request->type = $request->type ?? 1;
            $request->option = $request->option ?? 'desc';
            if ($request->type == 1) {
                $products = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
                    ->select(
                        'products.name', 'publish_id', 'price', 'discount_vShop', 'view', 'amount_product_sold', 'images',
                        'products.id'
                    )
                    ->join('products', 'vshop_product.product_id', '=', 'products.id')
                    ->where('vshop.pdone_id', $pdone_id)
                    ->where('vshop.status', 1);
//                ->paginate(10);
                if ($request->order_by = 1) {
                    $products = $products->orderBy('amount_product_sold', $request->option);
                }
                if ($request->order_by = 2) {
                    $products = $products->orderBy('amount_product_sold', $request->option);
                }
                foreach ($products as $pro) {
                    $pro->image = asset(json_decode($pro->image)[0]);
                    unset($pro->images);
                    $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pro->id)->first()->max;
                    $pro->available_discount = $more_dis ?? 0;
                }
            }
            if ($request->type == 2) {
                $products = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
                    ->select(
                        'products.name', 'publish_id', 'price', 'discount_vShop', 'view', 'amount_product_sold', 'images',
                        'products.id'
                    )
                    ->join('products', 'vshop_product.product_id', '=', 'products.id')
                    ->where('vshop.pdone_id', $pdone_id)
                    ->where('vshop.status', 2);
//                ->paginate(10);
                if ($request->order_by = 1) {
                    $products = $products->orderBy('amount_product_sold', $request->option);
                }
                if ($request->order_by = 2) {
                    $products = $products->orderBy('amount_product_sold', $request->option);
                }
                foreach ($products as $pro) {
                    $pro->image = asset(json_decode($pro->image)[0]);
                    unset($pro->images);
                    $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pro->id)->first()->max;
                    $pro->available_discount = $more_dis ?? 0;
                }
            }

            return response()->json([
                'success' => true,
                'data' => $products,
                'total_product' => $products->total()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }


    }

    public function delivery_off($product_id, $pdone_id)
    {

        $vshop_product = VshopProduct::join('vshop', 'vshop_products.vshop_id', '=', 'vshop.id')
            ->select('vshop_products.id')
            ->where('vshop_products.status', 2)
            ->where('vshop_products.product_id', $product_id)
            ->where('vshop.pdone_id', $pdone_id)->first();

        if (!$vshop_product) {
            return response()->json([
                'status_code' => 404,
                'message' => 'sản phẩm chưa được Vshop tiếp thị hoặc không tìm thấy',
            ], 404);
        }
        $insert_vshop_product = VshopProduct::find($vshop_product->id);
        if ($insert_vshop_product->delivery_off == 1) {


            $insert_vshop_product->delivery_off = 0;
            $insert_vshop_product->save();

        } else {

            $insert_vshop_product->delivery_off = 1;
            $insert_vshop_product->save();
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Thay đổi trạng thái giao nhận thành công'
        ], 200);
    }
}
