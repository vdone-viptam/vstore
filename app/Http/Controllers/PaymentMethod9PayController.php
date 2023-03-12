<?php

namespace App\Http\Controllers;

use App\Http\Lib9Pay\HMACSignature;
use App\Http\Lib9Pay\MessageBuilder;
use App\Models\Bill;
use App\Models\Order;
use App\Models\PaymentHistory;
use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PaymentMethod9PayController extends Controller
{
    public function payment9PayErr500() {
        return view('payment.payment500');
    }
    public function paymentErr() {
        return view('payment.paymentErr');
    }
    function paymentGet() {
        $bills = Bill::all();
        return view('welcome', compact('bills'));
    }

    function paymentSuccess() {
        return view('payment.paymentSuccess');
    }

    function paymentReturn(Request $request) {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if($hashChecksum === $checksum){
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if(!$checkPayment) {
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
            if($status === 5) {
                $bill = Bill::where('code', strtok($payment->invoice_no, '_'))
                    ->where('bill_payment_status', config('constants.billPaymentStatus.unpaid'))
                    ->first();
                if($bill) {
                    $bill->bill_payment_status = config('constants.billPaymentStatus.pay');
                    $bill->save();
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

    function paymentBack(Request $request) {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if($hashChecksum === $checksum){
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if(!$checkPayment) {
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

    function paymentCheck(Request $request) {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'checksum' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $checksum = $request->checksum;
        $merchantKeyChecksum = config('payment9Pay.merchantKeyChecksum');
        $hashChecksum = strtoupper(hash('sha256', $request->result . $merchantKeyChecksum));
        if($hashChecksum === $checksum){
            $result = base64_decode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;
            $checkPayment = PaymentHistory::where('payment_no', $payment->payment_no)->first();
//            $statusLabel = status9Pay($status);
            if(!$checkPayment) {
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
            if($status === 5) {
                $bill = Bill::where('code', strtok($payment->invoice_no, '_'))
                    ->where('bill_payment_status', config('constants.billPaymentStatus.unpaid'))
                    ->first();
                if($bill) {
                    $bill->bill_payment_status = config('constants.billPaymentStatus.pay');
                    $bill->save();
                    return response()->json([
                        "failure_reason" => 'Giao dịch thành công',
                        "status" => 1
                    ], 200);
                }
                Log::error('PAYMENT_9PAY: Lỗi nghiêm trọng, cổng thanh toán trả về invoice không khớp với hệ thống Vstore'.'-'.$payment->invoice_no);
                return response()->json([
                    "failure_reason" => 'Giao dịch thành công, vui lòng liên hệ với admin',
                    "status" => 0
                ], 200);
            }
            Log::error('PAYMENT_9PAY: '.$payment->failure_reason.'-'.$payment->invoice_no);
            return response()->json([
                "failure_reason" => $payment->failure_reason,
                "status" => $payment->status
            ], 200);
        } else {
            return response()->json([], 500);
        }
    }

    function payment(Request $request, $id, $userId) {
        $validator = Validator::make($request->all(), [
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD',
        ]);

        $method = $request->method_payment;
        $order = Order::where('id', $id)->where('pay', config('constants.payStatus.pay'))->first();
        if(!$order) {
            return response()->json([], 404);
        }
        dd($order);

//        $bill = new Bill();
//        $bill->code = Str::random('11');
//        $bill->name = $request->name;
//        $bill->pdone_id = $request->pdone_id;
//        $bill->phone_number = $request->phone_number;
//        $bill->address = $request->address;
//        $bill->method_payment = $method;
//        $bill->save();
//
//
//        if ($validator->fails()) {
//            return $validator->errors();
//        }
//        $bill = Bill::where('code', $request->invoice_no)->where('bill_payment_status', config('constants.billPaymentStatus.unpaid'))->first();
//        if(!$bill) {
//            return response()->json([
//                "message"=>"Hoá đơn này không tồn tại"
//            ], 404);
//        }
//        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
//
//        $returnUrl = $request->returnUrl ?? $http . config("domain.payment") . "/payment/return";
//        $backUrl = $request->backUrl ?? $http . config("domain.payment") . "/payment/back";
//        $time = time();
//        $invoiceNo = $request->invoice_no.'_'.$time;
//        $amount = $bill->total;
//        $merchantKey = config('payment9Pay.merchantKey');
//        $merchantKeySecret = config('payment9Pay.merchantKeySecret');
//        $merchantEndPoint = config('payment9Pay.merchantEndPoint');
//        $data = array(
//            'merchantKey' => $merchantKey,
//            'time' => $time,
//            'invoice_no' => $invoiceNo,
//            'description' => 'Đơn hàng Vdone',
//            'amount' => $amount,
//            'back_url' => $backUrl,
//            'return_url' => $returnUrl,
//            'is_customer_pay_fee' => 1 // Đối tượng chịu phí. 0: người bán chịu phí, 1: khách hàng chịu phí
//        );
//        $message = MessageBuilder::instance()
//            ->with($time, $merchantEndPoint . '/payments/create', 'POST')
//            ->withParams($data)
//            ->build();
//        $hmacs = new HMACSignature();
//        $signature = $hmacs->sign($message, $merchantKeySecret);
//        $httpData = [
//            'baseEncode' => base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE)),
//            'signature' => $signature,
//        ];
//        try {
//            $redirectUrl = $merchantEndPoint . '/portal?' . http_build_query($httpData);
//            return response()->json([
//                'redirectUrl'=>$redirectUrl,
//                'time' => $time,
//                'invoice_no' => $invoiceNo,
//                'amount' => $amount,
//                'back_url' => $backUrl,
//                'return_url' => $returnUrl,
//            ], 201);
//        } catch (Exception $e) {
//            Log::error($e);
//            return response()->json([
//                "message" => "500 Internal Server Error",
//                "errors" => $e
//            ], 500);
//        }
    }
}
