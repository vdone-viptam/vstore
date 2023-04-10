<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViettelpostController extends Controller
{
    public function index(Request $request){
//        $billdetail = BillDetail::all();
        $all = $request->all()['DATA']['ORDER_STATUS'];
        \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('all'));
        $data=$request->DATA;
        $a = $request->all()['DATA']['ORDER_NUMBER'];
        $order= Order::where('order_number',$request->all()['DATA']['ORDER_NUMBER'] )->first();
        \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('order','a'));
//        $billdetail->status = $data['ORDER_STATUS'];


        $order->order_status = $request->all()['DATA']['ORDER_STATUS'];
        if ($order->order_status == 501){
            $order->export_status =4;
            $order->updated_at= Carbon::now();
        }
;        $order->save();

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
