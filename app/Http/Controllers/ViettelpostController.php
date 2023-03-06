<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use Illuminate\Http\Request;

class ViettelpostController extends Controller
{
    public function index(Request $request){
//        $billdetail = BillDetail::all();
        $data=$request->DATA;
        $billdetail= BillDetail::where('code',$data['ORDER_NUMBER'])->first();
//        $billdetail->status = $data['ORDER_STATUS'];


        $billdetail->status = $data['ORDER_STATUS'];
        $billdetail->save();

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
