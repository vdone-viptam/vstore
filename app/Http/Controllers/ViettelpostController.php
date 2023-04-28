<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ViettelpostController extends Controller
{
    public function index(Request $request)
    {

        $all = $request->all()['DATA']['ORDER_STATUS'];
        \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('all'));
        $data = $request->DATA;
        $a = $request->all()['DATA']['ORDER_NUMBER'];
        $order = Order::where('order_number', $request->all()['DATA']['ORDER_NUMBER'])->first();
        \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('order', 'a'));


        if ($order) {
            $order->order_status = $request->all()['DATA']['ORDER_STATUS'];
            if ($order->order_status == 501) {
                $order->export_status = 4;
                $order->updated_at = Carbon::now();

                $order_item = OrderItem::where('order_id', $order->id)->first();
                if ($order_item) {

                    $product = Product::where('id', $order_item->product_id)->first();
                    if ($product) {
                        $ncc = User::where('id', $product->user_id)->first();
                        if ($ncc) {
                            $data = [
                                'title' => 'Bạn vừa có 1 thông báo mới',
                                'avatar' => asset('home/img/NCC.png') ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                                'message' => 'Đơn hàng ' . $order->no . ' đã giao thành công',
                                'created_at' => Carbon::now()->format('h:i A d / m / Y'),
                                'href' => route('screens.manufacture.order.index', ['key_search' => $order->no])
                            ];
                            $ncc->notify(new AppNotification($data));
                        }

                        $vstore = User::where('id', $product->vstore_id)->first();
                        if ($vstore) {
                            $data_vstore = [
                                'title' => 'Bạn vừa có 1 thông báo mới',
                                'avatar' => asset('home/img/Logo.png') ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                                'message' => 'Đơn hàng ' . $order->no . ' đã giao thành công',
                                'created_at' => Carbon::now()->format('h:i A d / m / Y'),
                                'href' => route('screens.vstore.order.index', ['key_search' => $order->no])
                            ];
                            $vstore->notify(new AppNotification($data_vstore));

                        }
                        $vshop = Vshop::where('id', $order_item->vshop_id)->first();
                        $my_boss = Http::get(config('domain.domain_vdone') . 'group/' . $vshop->pdone_id . '/my-boss');
                        if (count($my_boss['data']) > 0) {
                            $my_boss = json_decode($my_boss);
                            $my_boss_data = $my_boss->data;
                            if ($my_boss_data[0]->bossTeamId) {
                                $mess_boss_team = Http::post(config('domain.domain_vdone') . 'notifications/' . $my_boss_data[0]->bossTeamId, [
                                    'message' => 'Đơn hàng ' . $order->no . ' đã giao thành công ',
                                    'orderId' => $order->id,
                                    'type' => 10
                                ]);


                            }
                            if ($my_boss_data[0]->bossGroupId) {
                                $mess_boss_group = Http::post(config('domain.domain_vdone') . 'notifications/' . $my_boss_data[0]->bossGroupId, [
                                    'message' => 'Đơn hàng ' . $order->no . ' đã giao thành công ',
                                    'orderId' => $order->id,
                                    'type' => 10
                                ]);
                            }
                        }


                        $mess_vshop = Http::post(config('domain.domain_vdone') . 'notifications/' . $vshop->pdone_id, [
                            'message' => 'Đơn hàng ' . $order->no . ' đã giao thành công ',
                            'orderId' => $order->id,
                            'type' => 10
                        ]);

                    }

                }
            }
            if ($order->order_status == 503 || $order->order_status == 507) {
                $order->export_status = 5;
                $order->updated_at = Carbon::now();
            };
            $order->save();
        }


    }

    public function linkin($order_id)
    {

        $login = Http::post('https://partner.viettelpost.vn/v2/user/Login', [
            "USERNAME" => config('domain.TK_VAN_CHUYEN'),
            "PASSWORD" => config('domain.MK_VAN_CHUYEN')
        ]);

        $respon = Http::withHeaders([
            'Token' => $login['data']['token'],
        ])->post('https://partner.viettelpost.vn/v2/order/printing-code', [
            "ORDER_ARRAY" => [
                $order_id
            ]
        ]);
//        return "https://digitalize.viettelpost.vn/DigitalizePrint/report.do?type=2&bill=".$respon['message']."=&showPostage=1";
        if ($respon != '') {
//

            $data = file_get_contents("https://digitalize.viettelpost.vn/DigitalizePrint/report.do?type=2&bill=" . $respon['message'] . "=&showPostage=1", 0);
//            $data =  json_decode($data);
//            $data =  json_decode($data);


            return response()->json([
                'success' => true,
                'data' => $data,
                "href" => "https://digitalize.viettelpost.vn/DigitalizePrint/report.do?type=100&bill=" . $respon['message'] . "=&showPostage=1",
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'Lỗi không tìm thấy'
            ], 400);
        }

    }
}
