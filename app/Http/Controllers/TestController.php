<?php

namespace App\Http\Controllers;
use App\Models\BlanceChange;
use App\Models\BuyMoreDiscount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\UserReferral;
use App\Models\Vshop;
use App\Models\VshopProduct;
use Carbon\Carbon;
use Geocoder\Laravel\Facades\Geocoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
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


    public function tuyet(Request $request){
//        $request->order_id =
        if (empty($request->order_id)){
            return 'Nhập order_id';
        }
            $order = Order::Where('no',$request->order_id)->where('export_status','!=',4)->first();
            if ($order){
                $order->export_status=4;
                $order->updated_at = Carbon::now();
                $order->save();
            }
            return 'Ok rồi đấy';
    }
    public function chia(){

        try {

            DB::beginTransaction();
            $orders = Order::select('id','no','user_id')
                ->where('export_status', 4)
                ->where('status', '!=',2)
                ->where('is_split','!=',1)
                ->get();
            foreach ($orders as $order) {

                $item = OrderItem::where('order_id',$order->id)->first();

                if ($item){
                    $product = Product::select('discount', 'discount_vShop', 'price', 'user_id', 'vstore_id')->where('id', $item->product_id)->first();
                    $ncc= User::where('id',$product->user_id)->first();
                    $total = $item->price * $item->quantity;
//                    chia tiền ncc

                    if ($ncc){

                        $price_ncc =$total/100 *(100 - ($product->discount  + $item->discount_ncc)) ;
//                            tong_tien /100 * (100 - (discount + discount_vShop + diss_ncc))
                        $new_ncc_blance = new BlanceChange();
                        $new_ncc_blance->user_id=$ncc->id;
                        $new_ncc_blance->type=1;
                        $new_ncc_blance->title='Công tiền từ mã đơn hàng '.$order->no;
                        $new_ncc_blance->status=1;
                        $new_ncc_blance->money_history=$price_ncc;
                        $new_ncc_blance->save();
                        $ncc->money +=$price_ncc;
                        $ncc->save();
                    }
//                        chia vsore
                    $vstore = User::where('id',$product->vstore_id)->first();
                    if ($vstore){
                        $phan_tram_con_lai= $product->discount -($product->discount_vShop +$item->discount_vstore);
                        if ($phan_tram_con_lai >0){
                            $price_vstore = $total /100 * $phan_tram_con_lai;
//                                tong_tien /100 * (chiet_khau_vstore - (chhiet_khau_vshop + giam_gia_vstore))
                        }else{
                            $price_vstore=0;
                        }
                        $new_vstore_blance = new BlanceChange();
                        $new_vstore_blance->user_id=$vstore->id;
                        $new_vstore_blance->type=1;
                        $new_vstore_blance->title='Công tiền từ mã đơn hàng '.$order->no;
                        $new_vstore_blance->status=1;
                        $new_vstore_blance->money_history=$price_vstore;
                        $new_vstore_blance->save();
                        $vstore->money +=$price_ncc;
                        $vstore->save();
                    }
//                        chia vshop
                    $vshop = Vshop::where('id',$item->vshop_id)->first();
                    if ($vshop){
                        $vshop_con_lai = $product->discount_vShop - $item->discount_vshop;
                        $price_vshop = $total /100 * $vshop_con_lai;
                        $new_vshop_blance = new BlanceChange();
                        $new_vshop_blance->vshop_id=$vshop->id;
                        $new_vshop_blance->type=1;
                        $new_vshop_blance->title='Công tiền từ mã đơn hàng '.$order->no;
                        $new_vshop_blance->status=1;
                        $new_vshop_blance->money_history= round($price_vshop,0) * 0.95;
                        $new_vshop_blance->save();
//                    $hmac = 'ukey='.$order->no .'&value='. $price_vshop .'&orderId='.$order->id. '&userId=' . $vshop->pdone_id;
                        $hmac = 'sellerPDoneId='.$vshop->vshop_id .'&buyerId='. $order->user_id .'&ukey='.$order->no. '&value=' . round($price_vshop,0).'&orderId='.$order->id.'&userId='.$vshop->pdone_id;
//                    sellerPDoneId=VNO398917577&buyerId=2&ukey=25M7I5f9913085b842&value=500000&orderId=10&userId=63
                        $sig = hash_hmac('sha256',$hmac, 'vshopDevSecretKey');
                        $new_vshop_blance->save();
                        $data_res = [
                            'orderId'=>$order->id,
                            'userId'=>$vshop->pdone_id,
                            'value'=>round($price_vshop,0),
                            'ukey'=>$order->no,
                            'sellerPDoneId'=>$vshop->vshop_id,
                            'buyerId'=>$order->user_id,
                            'signature'=>$sig
                        ];



                        $respon =  Http::post(config('domain.domain_vdone').'vnd-wallet/v-shop/commission',
                            [
                                'orderId'=>$order->id,
                                'userId'=>(int)$vshop->pdone_id,
                                'value'=>round($price_vshop,0),
                                'ukey'=>$order->no,
                                'sellerPDoneId'=>$vshop->vshop_id,
                                'buyerId'=>$order->user_id,
                                'signature'=>$sig
                            ]

                        );

//                                ukey=ukey&value=value&orderId=orderId&userId=userId
                        $vshop->money += $price_vshop/100 *95;
                        $vshop->save();
                        return $data_res;

                    }

                    DB::table('order')->where('id',$order->id)->update(array(
                        'is_split'=>1,

                    ));
                }
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            Log::error($e->getMessage());
        }
    }



}
