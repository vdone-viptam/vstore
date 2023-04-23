<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Big Sale
 *
 * Danh sách api liên quan tới sản phẩm được giảm giá
 */
class BigSaleController extends Controller
{
    /**
     * Danh sách sản phẩm giảm giá
     *
     * API này sẽ trả về thông tin hiển thị sản phẩm giảm giá
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam category_id id danh mục sản phẩm
     * @urlParam pdone_id id user truyền khi quyền user là vshop
     * @urlParam order_by | 1 Sắp xếp mới nhất | 2 Sắp xếp theo giá | 3 Số sản phẩm đã bán
     * @urlParam option 1 asc | 2 desc Thứ tự sấp xếp
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 10
     * @urlParam payment Phương thức thanh toán 1 COD | 2 Chuyển khoản
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListProductSale(Request $request)
    {
        try {
            $limit = $request->limit ?? 12;
            $products = DB::table('products')
                ->where('availability_status', 1);
            $selected = ['products.id', 'images', 'publish_id', 'price', 'products.name',DB::raw("price - (price * IFNULL((SELECT SUM(discount /100)
                        FROM discounts WHERE start_date <= '" . \Illuminate\Support\Carbon::now() . "' and end_date >= '" . Carbon::now() . "'
                                        AND product_id = products.id AND type != 3 GROUP BY product_id),0)) as order_price")];
            if ($request->pdone_id) {
                $selected[] = 'discount_vShop as discountVstore';
            }
            $products = $products->select($selected);
            if ($request->category_id) {
                $products = $products->where('category_id', $request->category_id);
            }
            if ($request->order_by == 1) {
                $order_by = $request->option == 'asc' ? 'asc' : 'desc';
                $products = $products->orderBy('id', $order_by);
            }
            if ($request->order_by == 2) {
                $order_by_price = $request->option == 'asc' ? 'asc' : 'desc';
                $products = $products->orderBy('order_price', $order_by_price);
            }
            if ($request->order_by == 3) {
                $order_by_sold = $request->option == 'asc' ? 'asc' : 'desc';
                $products = $products->orderBy('amount_product_sold', $order_by_sold);
            }
            if ($request->payment) {
                if ($request->payment == 1) {
                    $products = $products->where('payment_on_delivery', 1);

                } else {
                    $products = $products->where('prepay', 1);
                }
            }
            $products = $products->
            join('discounts', 'products.id', '=', 'discounts.product_id')
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->where('type', '!=', 3)
                ->groupBy('discount_vShop')
                ->where('products.status', 2)
                ->paginate($limit);
            foreach ($products as $product) {
                $product->discount = round(DB::table('discounts')
                    ->selectRaw('SUM(discount) as dis')
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->where('product_id', $product->id)
                    ->whereIn('type', [1, 2])
                    ->first()->dis ?? 0, 2);
                $product->image = asset(json_decode($product->images)[0]);
                if ($request->pdone_id) {
                    $product->is_affiliate = DB::table('vshop_products')
                        ->join('vshop', 'vshop_products.vshop_id', '=', 'vshop.id')
                        ->where('product_id', $product->id)
                        ->whereIn('vshop_products.status', [1,2])
                        ->where('vshop.pdone_id', $request->pdone_id)
                        ->count();
                    $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $product->id)->first()->max;
                    $product->available_discount = $more_dis ?? 0;
                }
                unset($product->images);
            }

            return response()->json([
                'status_code' => 200,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
