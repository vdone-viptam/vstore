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
            'USERNAME' => '0813635868',
            'PASSWORD' => 'Ducanh6629417!',
        ]);
//        return $login['data']['token'];
        $loginLong = Http::withHeaders(
            [
                'Content-Type'=>' application/json',
                'Token'=>$login['data']['token']
            ]
        )->post('https://partner.viettelpost.vn/v2/user/ownerconnect', [
            'USERNAME' => '0813635868',
            'PASSWORD' => 'Ducanh6629417!',
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
            "LIST_ITEM"=>[

            ]
        ] );
//            return json_decode($get_list);
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
            "ORDER_SERVICE"=>"VCBO",
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
        foreach ($tinh_thanh['data'] as $va){
            if ($va['PROVINCE_ID'] ==4){
                return $va;
            }
        }
        return $tinh_thanh['data'];

//            $b = Http::get('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId=1');
//            return $b['data'];

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
