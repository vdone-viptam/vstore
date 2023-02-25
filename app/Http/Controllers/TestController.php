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
        $vshop_product = VshopProduct::where('id_pdone',11212)
            ->where('product_id',25)->first();
        return $vshop_product;
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
