<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AffProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:affProduct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chia hoa hồng';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {
            DB::beginTransaction();
            $orders = Order::with('orderItem')->select('id')->where('created_at', '>=', Carbon::now()
                ->addDays(-7))
                ->where('created_at', '<=', Carbon::now())
                ->where('status', 3)
                ->get();
            $data = [];
            foreach ($orders as $order) {
                foreach ($order->orderItem as $item) {
                    $product = Product::select('discount', 'discount_vShop', 'price', 'user_id', 'vstore_id')->where('id', $item->product_id);
                    $price = $product->price
                        - ($product->price * $item->discount_vshop / 100)
                        - ($product->price * $item->discount_vstore / 100)
                        - ($product->price * $item->discount_ncc / 100);
                    $data[] = [
                        'vshop_id' => $item->vshop_id,
                        'type' => 1,
                        'title' => 'Tiền chuyển vào',
                        'status' => 1,
                        'created_at' => Carbon::now(),
                        'money_history' => $price * $product->discount_vShop / 100
                    ];
                    $vshop = Vshop::find($item->vshop_id);
                    $vshop->money += $price * $product->discount_vShop / 100;
                    $vshop->save();
                    $data[] = [
                        'user_id' => $product->user_id,
                        'type' => 1,
                        'title' => 'Tiền chuyển vào',
                        'status' => 1,
                        'created_at' => Carbon::now(),
                        'money_history' => $price * (100 - $product->discount_vShop - $product->discount) / 100
                    ];

                    $user1 = User::find($product->user_id);
                    $user1->money += $price * (100 - $product->discount_vShop - $product->discount) / 100;
                    $user1->save();
                    $data[] = [
                        'user_id' => $product->vstore_id,
                        'type' => 1,
                        'title' => 'Tiền chuyển vào',
                        'status' => 1,
                        'created_at' => Carbon::now(),
                        'money_history' => $price * $product->discount / 100
                    ];
                    $user2 = User::find($product->vstore_id);
                    $user2->money += $price * $product->discount / 100;
                    $user2->save();
                }
            }

            DB::table('balance_change_history')->insert($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }
}
