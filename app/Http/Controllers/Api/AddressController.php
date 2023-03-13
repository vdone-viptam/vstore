<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
//    public function import(){
//        $response = Http::get('https://partner.viettelpost.vn/v2/categories/listProvince');
//        $data =  json_decode($response)->data;
//
//        foreach ($data as $val){
//
//            $newProvince = new Province();
//
//            $newProvince->province_id = $val->PROVINCE_ID;
//            $newProvince->province_name=$val->PROVINCE_NAME;
//            $newProvince->province_code = $val->PROVINCE_CODE;
//            $newProvince->save();
//
//            $district = json_decode(Http::get('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId=' . $val->PROVINCE_ID))->data;
//
//            foreach ($district as $dis){
////                return $dis;
//                if ($dis->PROVINCE_ID ==  $val->PROVINCE_ID){
//
//                    $newDistrict = new District();
//                    $newDistrict->district_id = $dis->DISTRICT_ID;
//                    $newDistrict->province_id = $dis->PROVINCE_ID;
//                    $newDistrict->district_name = $dis->DISTRICT_NAME;
//                    $newDistrict->district_value=$dis->DISTRICT_VALUE;
//                    $newDistrict->save();
//                }
//
//                $wards = json_decode(Http::get('https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$dis->DISTRICT_ID))->data;
//                foreach ($wards as $wa){
//                    if ($dis->DISTRICT_ID ==$wa->DISTRICT_ID){
//                        $newWard = new Ward();
//                        $newWard->district_id= $wa->DISTRICT_ID;
//                        $newWard->wards_id= $wa->WARDS_ID;
//                        $newWard->wards_name= $wa->WARDS_NAME;
//                        $newWard->save();
//                    }
//
//                }
//            }
//
//
//        }
//
//
//    }
//

    /**
     * danh sách tỉnh thành
     *
     * API này sẽ trả về danh sách tỉnh thành
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProvince(){
        $model = Province::all();
        return response()->json([
            'success' => true,
            'data' => $model
        ], 200);
    }
    /**
     * danh sách quận huyện
     *
     * API này sẽ trả về danh sách quận huyện
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrict($id){
        $model = District::where('province_id',$id)->get();
        return response()->json([
            'success' => true,
            'data' => $model
        ], 200);
    }
    /**
     * danh sách xã phường
     *
     * API này sẽ trả về danh sách quận huyện
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWards($id){
        $model = Ward::where('district_id',$id)->get();
        return response()->json([
            'success' => true,
            'data' => $model
        ], 200);
    }

}
