<?php

namespace App\Console\Commands;

use App\Models\Banner;
use App\Models\BlanceChange;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AffOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:split';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
                        $new_vshop_blance->money_history= $price_vshop * 0.95;
                        $new_vshop_blance->save();
//                    $hmac = 'ukey='.$order->no .'&value='. $price_vshop .'&orderId='.$order->id. '&userId=' . $vshop->pdone_id;
                        $hmac = 'sellerPDoneId='.$vshop->vshop_id .'&buyerId='. $order->user_id .'&ukey='.$order->no. '&value=' . $price_vshop.'&orderId='.$order->id.'&userId='.$vshop->pdone_id;
//                    sellerPDoneId=VNO398917577&buyerId=2&ukey=25M7I5f9913085b842&value=500000&orderId=10&userId=63
                        $sig = hash_hmac('sha256',$hmac, 'vshopDevSecretKey');
                        $new_vshop_blance->code=$sig;
                        $new_vshop_blance->save();
                        if ($order->user_id==''){
                            return 1;
                        }

                        $respon =  Http::post(config('domain.domain_vdone').'vnd-wallet/v-shop/commission',
                            [
                                'orderId'=>$order->id,
                                'userId'=>$vshop->pdone_id,
                                'value'=>$price_vshop,
                                'ukey'=>$order->no,
                                'sellerPDoneId'=>$vshop->vshop_id,
                                'buyerId'=>$order->user_id,
                                'signature'=>$sig
                            ]
                        );
//                                ukey=ukey&value=value&orderId=orderId&userId=userId
                        $vshop->money += $price_vshop/100 *95;
                        $vshop->save();
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
