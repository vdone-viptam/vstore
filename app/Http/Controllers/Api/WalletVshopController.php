<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vshop;
use Illuminate\Http\Request;
/**
 * @group Wallet
 *
 * Danh sách api liên quan ví vshop
 */
class WalletVshopController extends Controller
{

    public function surplus($pdone_id){
        $surplus = Vshop::select('money')->where('pdone_id',$pdone_id)->first();
        if ($surplus){
            return response()->json([
                'status_code' => 200,
                'data' => $surplus,

            ],200);
        }else{
            return response()->json([
                'status_code' => 400,
                'message' => 'không tìm thấy thông tin vshop',

            ],400);
        }
    }
}
