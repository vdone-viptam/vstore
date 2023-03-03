<?php

namespace App\Http\Controllers;
use App\Models\BuyMoreDiscount;
use App\Models\VshopProduct;
use Geocoder\Laravel\Facades\Geocoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SKAgarwal\GoogleApi\PlacesApi;

class TestController extends Controller
{
    public function index()
    {

//        $address = "hà nội";
//        $result = app('geocoder')->geocode($address)->get();
//        $coordinates = $result[0]->getCoordinates();
//        $lat = $coordinates->getLatitude();
//        $long = $coordinates->getLongitude();
//        return $lat.','.$long;

        $login = Http::post('https://partner.viettelpost.vn/v2/user/Login', [
            'USERNAME' => env('TK_VAN_CHUYEN'),
            'PASSWORD' => env('MK_VAN_CHUYEN'),
        ]);
//        return $login;
        $loginLong = Http::withHeaders(
            [
                'Content-Type'=>' application/json',
                'Token'=>$login['data']['token']
            ]
        )->post('https://partner.viettelpost.vn/v2/user/ownerconnect', [
            'USERNAME' => env('TK_VAN_CHUYEN'),
            'PASSWORD' => env('MK_VAN_CHUYEN'),
        ] );
//        return $loginLong['data'];
        // lấy danh sách phù hợp với hành chình

        $get_list = Http::withHeaders(
            [
                'Content-Type'=>' application/json',
                'Token'=>$login['data']['token']
            ]
        )->post('https://partner.viettelpost.vn/v2/order/getPriceAll',[
            'SENDER_DISTRICT'=>12,
            'SENDER_PROVINCE'=>1,
            'RECEIVER_DISTRICT'=>12,
            'RECEIVER_PROVINCE'=>1,
            'PRODUCT_TYPE'=>'HH',
            'PRODUCT_WEIGHT'=>100000,
            'PRODUCT_PRICE'=>500000,
            'MONEY_COLLECTION'=>"500000",
            'TYPE'=>1,

        ] );
//            return $get_list[0]['MA_DV_CHINH'];
            // tính cước
        $tinh_cuoc = Http::withHeaders(
            [
                'Content-Type'=>' application/json',
                'Token'=>$login['data']['token']
            ]
        )->post('https://partner.viettelpost.vn/v2/order/getPrice' ,[
            "PRODUCT_WEIGHT"=>100,
            "PRODUCT_PRICE"=>96000,
            "MONEY_COLLECTION"=>0,
            "ORDER_SERVICE_ADD"=>"",
            "ORDER_SERVICE"=>$get_list[0]['MA_DV_CHINH'],
            "SENDER_DISTRICT"=>12,
            "SENDER_PROVINCE"=>1,
            "RECEIVER_DISTRICT"=>12,
            "RECEIVER_PROVINCE"=>1,
            "PRODUCT_TYPE"=>"HH",
            "NATIONAL_TYPE"=>1
        ]);
//        return json_decode($tinh_cuoc) ;
        // tạo đơn
        $create = Http::withHeaders(
            [
                'Content-Type'=>' application/json',
                'Token'=>$login['data']['token']
            ]
        )->post('https://partner.viettelpost.vn/v2/order/createOrderNlp' );
//        return $create;
        $tinh_thanh = Http::get('https://partner.viettelpost.vn/v2/categories/listProvince');
//        foreach ($tinh_thanh['data'] as $va){
//            if ($va['PROVINCE_ID'] ==4){
//                return $va;
//            }
//        }
//        return $tinh_thanh['data'];

//            $b = Http::get('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId=1');
//            return $b['data'];

        $taodon = Http::withHeaders(
            [
                'Content-Type'=>' application/json',
                'Token'=>$login['data']['token']
            ]
        )->post('https://partner.viettelpost.vn/v2/order/createOrderNlp' ,[
            "ORDER_NUMBER"=>'',
            "SENDER_FULLNAME"=>"Duong An-04",
            "SENDER_ADDRESS"=>"Soso18, Phường Thạnh Xuân, Quận 12,Hồ Chí Minh",
            "SENDER_PHONE"=>"09335656565",
            "RECEIVER_FULLNAME"=>"Nguyễn Văn A",
//            "RECEIVER_FULLNAME"=>$get_list[0]['MA_DV_CHINH'],
            "RECEIVER_ADDRESS"=>"Soso18, Phường Thạnh Xuân, Quận 12,Hồ Chí Minh",
            "RECEIVER_PHONE"=>"0987654321",
            "PRODUCT_NAME"=>"hàng test",
            "PRODUCT_DESCRIPTION"=>"",
            "PRODUCT_QUANTITY"=>1,
            "PRODUCT_PRICE"=>100000,
            "PRODUCT_WEIGHT"=>10000,
            "PRODUCT_LENGTH"=>0,
            "PRODUCT_WIDTH"=>0,
            "PRODUCT_HEIGHT"=>0,
            "ORDER_PAYMENT"=>0,
            "ORDER_SERVICE"=>$get_list[0]['MA_DV_CHINH'],
            "ORDER_SERVICE_ADD"=>null,
            "ORDER_NOTE"=>"",
            "MONEY_COLLECTION"=>56827,
            "LIST_ITEM"=>[
                [
                    "PRODUCT_NAME"=>"Hàng test",
                    "PRODUCT_QUANTITY"=>1,
                    "PRODUCT_PRICE"=>10000000,
                    "PRODUCT_WEIGHT"=>10000
                ]
            ]
        ]);
        return $taodon['error'];

    }

    public function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function get_lat_long($address){

//        $going=$this->input->post('going');
//
//        $address =$going; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $apiKey = 'AIzaSyCaBHNoze8nddzONgQDZkFPtEheSWnlYzQ'; // Google maps now requires an API key.
        try {
            $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?
   address='.urlencode($address).'&sensor=false&key='.$apiKey);
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }


        //print_r($geocode);

        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
        return [$latitude,$longitude];
    }
}
