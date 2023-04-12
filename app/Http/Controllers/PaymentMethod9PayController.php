<?php

namespace App\Http\Controllers;

use App\Http\Lib9Pay\HMACSignature;
use App\Http\Lib9Pay\MessageBuilder;
use App\Models\Bill;
use App\Models\CartItemV2;
use App\Models\CartV2;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderService;
use App\Models\PaymentHistory;
use App\Models\PreOrderVshop;
use App\Models\User;
use App\Models\RequestWarehouse;
use App\Models\Warehouses;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Http\Client\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PaymentMethod9PayController extends Controller
{
    public function payment9PayErr500()
    {
        return view('payment.payment500');
    }

    public function paymentErr()
    {
        return view('payment.paymentErr');
    }

    function paymentSuccess()
    {
        return view('payment.paymentSuccess');
    }

    function paymentReturn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if ($hashChecksum === $checksum) {
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if (!$checkPayment) {
                // Tạo lịch sử hoá đơn
                $paymentHistory = new PaymentHistory();
                $paymentHistory->amount = $payment->amount;
                $paymentHistory->amount_foreign = $payment->amount_foreign;
                $paymentHistory->amount_original = $payment->amount_original;
                $paymentHistory->amount_request = $payment->amount_request;
                $paymentHistory->bank = $payment->bank;
                $paymentHistory->card_brand = $payment->card_brand;
                $paymentHistory->card_info = json_encode($payment->card_info);
                $paymentHistory->currency = $payment->currency;
                $paymentHistory->description = $payment->description;
                $paymentHistory->error_code = $payment->error_code;
                $paymentHistory->exc_rate = $payment->exc_rate;
                $paymentHistory->failure_reason = $payment->failure_reason;
                $paymentHistory->foreign_currency = $payment->foreign_currency;
                $paymentHistory->invoice_no = $payment->invoice_no;
                $paymentHistory->lang = $payment->lang;
                $paymentHistory->method = $payment->method;
                $paymentHistory->payment_no = $payment->payment_no;
                $paymentHistory->status = $payment->status;
                $paymentHistory->tenor = $payment->tenor;
                $paymentHistory->save();
                //End Tạo lịch sử hoá đơn
            }

            if ($status === 5) {
                $order = Order::where('no', $payment->invoice_no)
                    ->where('status', config('constants.payStatus.pay'))
                    ->where('payment_status', config('constants.paymentStatus.no_done'))
                    ->first();

                if ($order) {
                    $order->payment_status = config('constants.paymentStatus.done');

                    $order_item = OrderItem::where('order_id', $order->id)->first();
                    $requestEx = new RequestWarehouse();

                    $requestEx->ncc_id = 0;
                    $requestEx->product_id = $order_item->product_id;
                    $requestEx->status = 0;
                    $requestEx->type = 10;
                    $requestEx->ware_id = $order->warehouse_id;
                    $requestEx->quantity = $order_item->quantity;
                    $code = $order->no;
                    $requestEx->order_number = '';
                    $requestEx->code = $code;
                    $requestEx->note = 'Đơn hàng mới';
                    $requestEx->save();

                    $order->request_warehouse_id = $requestEx->id;

                    $order->save();

                    $ware_user = Warehouses::select('user_id')->where('id', $order->warehouse_id)->first();
                    $user = User::find($ware_user->user_id);
                    $data = [
                        'title' => 'Bạn vừa có 1 thông báo mới',
                        'avatar' => '',
                        'message' => 'Bạn vừa có đơn hàng mới',
                        'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                        'href' => route('screens.storage.product.requestOut', ['key_search' => $code])
                    ];
                    $user->notify(new AppNotification($data));
                    // nếu tồn tại URL return
                    if ($request->url) {
                        return redirect()->to($request->url . "?result=" . $request->result);
                    }
                    return redirect()->route('paymentSuccess');
                }
                Log::error('PAYMENT_9PAY: Lỗi nghiêm trọng, cổng thanh toán trả về invoice không khớp với hệ thống Vstore');
                return redirect()->route('paymentErr', [
                    "failure_reason" => 'Giao dịch thành công, vui lòng liên hệ với admin',
                    "status" => 0
                ]);
            }

            // nếu tồn tại URL return
            if ($request->url) {
                return redirect()->to($request->url . "?result=" . $request->result);
            }

            return redirect()->route('paymentErr', [
                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ]);
        } else {

            // nếu tồn tại URL return
            if ($request->url) {
                return redirect()->to($request->url . "?result=" . $request->result);
            }

            return redirect()->route('payment500');
        }
    }

    function paymentOrderServiceReturn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if ($hashChecksum === $checksum) {
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if (!$checkPayment) {
                // Tạo lịch sử hoá đơn
                $paymentHistory = new PaymentHistory();
                $paymentHistory->amount = $payment->amount;
                $paymentHistory->amount_foreign = $payment->amount_foreign;
                $paymentHistory->amount_original = $payment->amount_original;
                $paymentHistory->amount_request = $payment->amount_request;
                $paymentHistory->bank = $payment->bank;
                $paymentHistory->card_brand = $payment->card_brand;
                $paymentHistory->card_info = json_encode($payment->card_info);
                $paymentHistory->currency = $payment->currency;
                $paymentHistory->description = $payment->description;
                $paymentHistory->error_code = $payment->error_code;
                $paymentHistory->exc_rate = $payment->exc_rate;
                $paymentHistory->failure_reason = $payment->failure_reason;
                $paymentHistory->foreign_currency = $payment->foreign_currency;
                $paymentHistory->invoice_no = $payment->invoice_no;
                $paymentHistory->lang = $payment->lang;
                $paymentHistory->method = $payment->method;
                $paymentHistory->payment_no = $payment->payment_no;
                $paymentHistory->status = $payment->status;
                $paymentHistory->tenor = $payment->tenor;
                $paymentHistory->save();
                //End Tạo lịch sử hoá đơn
            }
            return redirect()->route('paymentErr', [
                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ]);
        } else {
            return redirect()->route('payment500');
        }
    }

    function paymentOrderServiceBack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));

        if ($hashChecksum === $checksum) {
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
            if (!$checkPayment) {
                // Tạo lịch sử hoá đơn
                $paymentHistory = new PaymentHistory();
                $paymentHistory->amount = $payment->amount;
                $paymentHistory->amount_foreign = $payment->amount_foreign;
                $paymentHistory->amount_original = $payment->amount_original;
                $paymentHistory->amount_request = $payment->amount_request;
                $paymentHistory->bank = $payment->bank;
                $paymentHistory->card_brand = $payment->card_brand;
                $paymentHistory->card_info = json_encode($payment->card_info);
                $paymentHistory->currency = $payment->currency;
                $paymentHistory->description = $payment->description;
                $paymentHistory->error_code = $payment->error_code;
                $paymentHistory->exc_rate = $payment->exc_rate;
                $paymentHistory->failure_reason = $payment->failure_reason;
                $paymentHistory->foreign_currency = $payment->foreign_currency;
                $paymentHistory->invoice_no = $payment->invoice_no;
                $paymentHistory->lang = $payment->lang;
                $paymentHistory->method = $payment->method;
                $paymentHistory->payment_no = $payment->payment_no;
                $paymentHistory->status = $payment->status;
                $paymentHistory->tenor = $payment->tenor;
                $paymentHistory->save();
                //End Tạo lịch sử hoá đơn
            }
            if ($status === 5) {
                $order = OrderService::where('no', $payment->invoice_no)
                    ->where('status', config('constants.orderServiceStatus.confirmation'))
                    ->where('payment_status', config('constants.paymentStatus.no_done'))
                    ->first();
                if ($order) {
                    $order->status = 1;
                    $order->payment_status = config('constants.paymentStatus.done');
                    $order->save();
                    $user = User::find($order->user_id);

                    if ($order->type == "NCC") {
                        return redirect()->route('landingpagencc', [
                            "order" => $order,
                            "user" => $user
                        ]);
                    } else if ($order->type == "KHO") {
                        return redirect()->route('screens.storage.index', [
                            "order" => $order,
                            "user" => $user
                        ]);
                    }
                }

                Log::error('PAYMENT_9PAY: Lỗi nghiêm trọng, cổng thanh toán trả về invoice không khớp với hệ thống Vstore');
                return redirect()->route('register_ncc', [
                    "orderErr" => 'Giao dịch thành công, vui lòng liên hệ với admin',
                    "status" => 0
                ])->with([
                    "orderErr" => 'Giao dịch thành công, vui lòng liên hệ với admin',
                    "status" => 0
                ]);
            }
            return redirect()->route('register_ncc', [
                "orderErr" => "Hành động không được thực hiện, vui lòng đăng ký lại",
//                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ])->with([
                "orderErr" => "Hành động không được thực hiện, vui lòng đăng ký lại",
//                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ]);
        } else {
            return redirect()->route('register_ncc', [
                "orderErr" => "Hành động không được thực hiện, vui lòng đăng ký lại"
            ])->with([
                "orderErr" => "Hành động không được thực hiện, vui lòng đăng ký lại"
            ]);
        }
    }

    function paymentPreOrderReturn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if ($hashChecksum === $checksum) {
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if (!$checkPayment) {
                // Tạo lịch sử hoá đơn
                $paymentHistory = new PaymentHistory();
                $paymentHistory->amount = $payment->amount;
                $paymentHistory->amount_foreign = $payment->amount_foreign;
                $paymentHistory->amount_original = $payment->amount_original;
                $paymentHistory->amount_request = $payment->amount_request;
                $paymentHistory->bank = $payment->bank;
                $paymentHistory->card_brand = $payment->card_brand;
                $paymentHistory->card_info = json_encode($payment->card_info);
                $paymentHistory->currency = $payment->currency;
                $paymentHistory->description = $payment->description;
                $paymentHistory->error_code = $payment->error_code;
                $paymentHistory->exc_rate = $payment->exc_rate;
                $paymentHistory->failure_reason = $payment->failure_reason;
                $paymentHistory->foreign_currency = $payment->foreign_currency;
                $paymentHistory->invoice_no = $payment->invoice_no;
                $paymentHistory->lang = $payment->lang;
                $paymentHistory->method = $payment->method;
                $paymentHistory->payment_no = $payment->payment_no;
                $paymentHistory->status = $payment->status;
                $paymentHistory->tenor = $payment->tenor;
                $paymentHistory->save();
                //End Tạo lịch sử hoá đơn
            }
            if ($status === 5) {
                $order = PreOrderVshop::where('no', $payment->invoice_no)
                    ->where('status', 2)
                    ->where('payment_deposit_money_status', 2)
                    ->first();
                if ($order) {
                    $order->payment_deposit_money_status = 1;
                    $order->save();
                    return redirect()->route('paymentSuccess');
                }
                Log::error('PAYMENT_9PAY: Lỗi nghiêm trọng, cổng thanh toán trả về invoice không khớp với hệ thống Vstore');
                return redirect()->route('paymentErr', [
                    "failure_reason" => 'Giao dịch thành công, vui lòng liên hệ với admin',
                    "status" => 0
                ]);
            }
            return redirect()->route('paymentErr', [
                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ]);
        } else {
            return redirect()->route('payment500');
        }
    }

    function paymentPreOrderBack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if ($hashChecksum === $checksum) {
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if (!$checkPayment) {
                // Tạo lịch sử hoá đơn
                $paymentHistory = new PaymentHistory();
                $paymentHistory->amount = $payment->amount;
                $paymentHistory->amount_foreign = $payment->amount_foreign;
                $paymentHistory->amount_original = $payment->amount_original;
                $paymentHistory->amount_request = $payment->amount_request;
                $paymentHistory->bank = $payment->bank;
                $paymentHistory->card_brand = $payment->card_brand;
                $paymentHistory->card_info = json_encode($payment->card_info);
                $paymentHistory->currency = $payment->currency;
                $paymentHistory->description = $payment->description;
                $paymentHistory->error_code = $payment->error_code;
                $paymentHistory->exc_rate = $payment->exc_rate;
                $paymentHistory->failure_reason = $payment->failure_reason;
                $paymentHistory->foreign_currency = $payment->foreign_currency;
                $paymentHistory->invoice_no = $payment->invoice_no;
                $paymentHistory->lang = $payment->lang;
                $paymentHistory->method = $payment->method;
                $paymentHistory->payment_no = $payment->payment_no;
                $paymentHistory->status = $payment->status;
                $paymentHistory->tenor = $payment->tenor;
                $paymentHistory->save();
                //End Tạo lịch sử hoá đơn
            }
            return redirect()->route('paymentErr', [
                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ]);
        } else {
            return redirect()->route('payment500');
        }
    }

    /**
     * Thanh toán
     *
     * API dùng để thanh toán
     *
     * @param Request $request
     * @param $id "Id order"
     * @param $user_id "user id"
     * @param $method_payment "ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD"
     * @return JsonResponse
     */
    function payment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD',
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        $method = $request->method_payment;
        $user_id = $request->user_id;

        $order = Order::where('id', $id)
            ->where('user_id', $user_id)
            ->where('pay', config('constants.payStatus.pay'))
            ->where('status', 2)
            ->first();

        if (!$order) {
            return response()->json([
                "status_code" => 404,
                "message" => "Hoá đơn không tồn tại"
            ], 404);
        }
        $orderItems = OrderItem::where('order_id', $order->id)->first(); // Hiện tại đang làm 1
        if ($method === 'COD') {
            $order->status = config('constants.orderStatus.confirmation');
            $order->method_payment = $method;
            $order->save();
            $cart = CartV2::where('user_id', $order->user_id)
                ->first();
            CartItemV2::where('cart_id', $cart->id)
                ->where('product_id', $orderItems->product_id)
                ->delete();

            $requestEx = new RequestWarehouse();

            $requestEx->ncc_id = 0;
            $requestEx->product_id = $orderItems->product_id;
            $requestEx->status = 0;
            $requestEx->type = 10;
            $requestEx->ware_id = $order->warehouse_id;
            $requestEx->quantity = $orderItems->quantity;
            $code = $order->no;
            $requestEx->order_number = '';
            $requestEx->code = $code;
            $requestEx->note = 'Đơn hàng mới';
            $requestEx->save();

            $order->request_warehouse_id = $requestEx->id;

            $order->save();

            $ware_user = Warehouses::select('user_id')->where('id', $order->warehouse_id)->first();
            $user = User::find($ware_user->user_id);
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => '',
                'message' => 'Bạn vừa có đơn hàng mới',
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.storage.product.requestOut', ['key_search' => $code])
            ];
            $user->notify(new AppNotification($data));
            return response()->json([
                "status_code" => 200,
                "message" => "Đặt hàng thành công"
            ]);
        } else {
            $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';

            $returnUrl = $http . config("domain.payment") . "/payment/return";
            $backUrl = $http . config("domain.payment") . "/payment/back";

            if ($request->return_url && $request->back_url) {
                $returnUrl = $returnUrl . "?url=" . $request->return_url;
                $backUrl = $backUrl . "?url=" . $request->back_url;
            }

//        date_default_timezone_set('UTC');
            $time = time();
            $invoiceNo = $order->no;
            $amount = ceil($order->total);
            $merchantKey = config('payment9Pay.merchantKey');
            $merchantKeySecret = config('payment9Pay.merchantKeySecret');
            $merchantEndPoint = config('payment9Pay.merchantEndPoint');

            $data = array(
                'merchantKey' => $merchantKey,
                'time' => $time,
                'invoice_no' => $invoiceNo,
                'description' => 'Đơn hàng Vdone',
                'amount' => $amount,
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

            $order->method_payment = $method;
            $order->save();

            $cart = CartV2::where('user_id', $order->user_id)
                ->first();

            if ($cart) {
                CartItemV2::where('cart_id', $cart->id)
                    ->where('product_id', $orderItems->product_id)
                    ->delete();
            }

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
    }
}
