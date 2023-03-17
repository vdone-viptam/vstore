<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\Order;
use Illuminate\Http\Request;

class ViettelpostController extends Controller
{
    public function index(Request $request){
//        $billdetail = BillDetail::all();
        $all = $request->all();
        \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('all'));
        $data=$request->DATA;
        $order= Order::where('order_number',$data['ORDER_NUMBER'])->first();
//        $billdetail->status = $data['ORDER_STATUS'];


        $order->order_status = $data['ORDER_STATUS'];
        $order->save();

//        $billdetail->status = 'abc';
//        $billdetail->test = 'abc';
//        $billdetail->save();

//        return response()->json([
//            'status_code' => 200,
//            'message' => 'ok',
//
//        ]);

//        if ($request->TOKEN ==123456){
//            $data = $request->DATA;
//            $billdetail= BillDetail::where('code',$data->ORDER_NUMBER)->first();
//            $billdetail->status = $data->ORDER_STATUS;
//            $billdetail->save();
//        }
    }
}
