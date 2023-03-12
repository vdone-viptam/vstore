<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\BillProduct;
use App\Models\BuyMoreDiscount;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;

/**
 * @group Product
 *
 * Danh sách api liên quan tới sản phẩm
 */
class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     *
     * API này sẽ trả về thông tin hiển thị sản phẩm
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam category_id id danh mục sản phẩm
     * @urlParam order_by (1,2,3) 1 Sắp xếp theo id,2 sắp xếp theo giá,3 sắp xếp theo số hàng đã bán
     * @urlParam option (asc,desc)
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 10
     * @urlParam payment Phương thức thanh toán 1 COD | 2 Chuyển khoản
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
//        return config('domain.token');
        try {

            $limit = $request->limit ?? 10;
            $products = Product::where('vstore_id', '!=', null)->where('status', 2)->where('publish_id', '!=', null);
            $selected = ['id', 'name', 'publish_id', 'images', 'price'];
            $request->option=1?'asc':'desc';
            if ($request->pdone_id) {
                $selected[] = 'discount';
            }
            $products = $products->select($selected);
            if ($request->category_id) {
                $products = $products->where('category_id', $request->category_id);
            }
            if ($request->order_by == 1) {

                $products = $products->orderBy('id', 'desc');
            }
            if ($request->order_by == 3) {

                $products = $products->orderBy('amount_product_sold', 'desc');
            }
            if ($request->order_by == 2) {
                $products = $products->orderBy('price', $request->option);
            }
            if ($request->payment) {
                if ($request->payment == 1) {
                    $products = $products->where('payment_on_delivery', 1);

                } else {
                    $products = $products->where('prepay', 1);
                }
            }
//        return 1;

            $products = $products->paginate($limit);

            foreach ($products as $pro) {
                $pro->images = asset(json_decode($pro->images)[0]);
                $discount = DB::table('discounts')->selectRaw('sum(discount) as sum')->where('product_id', $pro->id)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->first()->sum;
                $pro->discount = $discount ?? 0;
                if ($request->pdone_id) {
                    $pro->is_affiliate = DB::table('vshop_products')->where('product_id', $pro->id)->where('status', 1)->where('pdone_id', $request->pdone_id)->count();
                    $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pro->id)->first()->max;
                    $pro->available_discount = $more_dis ?? 0;
                }

//
            }
            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],500);
        }

    }

    /**
     * Tìm kiếm sản phẩm theo tên
     *
     * API này sẽ trả về danh sách sản phẩm có tên chứa kí tự tìm kiếm
     *
     * @param Request $key_word Từ khóa tìm kiếm sản phẩm (tên sản phẩm)
     * @return \Illuminate\Http\JsonResponse
     */

    public
    function searchProductByKeyWord($key_word)
    {
        $products = Product::select('id', 'name')->where('status', 2)->where('name', 'like', '%' . $key_word . '%')->get();

        return response()->json([
            'status_code' => 200,
            'data' => $products
        ]);
    }


    /**
     * Danh sách sản phẩm theo danh mục
     *
     * API này sẽ trả về sản phẩm theo danh mục
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @return JsonResponse
     */
    public
    function productByCategory(Request $request, $id)
    {
        $limit = $request->limit ?? 10;
        $products = Product::where('category_id', $id)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $products,
        ]);


    }

    /**
     * Danh sách sản phẩm vstore
     *
     * API này sẽ trả về sách sản phẩm vstore
     *
     * @param Request $request
     * @param $id id của vstore
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam publish_id tìm kiếm theo mã sản phẩm mã sản phẩm
     * @urlParam category_id tìm kiếm theo danh mục
     * @urlParam order_by_price sắp xếp theo giá
     * @urlParam order_by_id sắp xếp theo id
     * @urlParam order_by_sold sắp xếp theo sl đã bán
     * @urlParam payments sắp xếp theo hình thức thanh toán 1 là COD 2 là trả trước
     * @return JsonResponse
     */
    public
    function productByVstore(Request $request, $id)
    {
        $limit = $request->limit ?? 10;

        $products = Product::where('vstore_id', $id)->where('status', 2)
            ->select('id', 'publish_id', 'discount', 'name', 'category_id', 'description', 'images', 'brand', 'weight', 'length', 'height', 'volume', 'price', 'amount_product_sold', 'prepay', 'payment_on_delivery', 'vstore_id', 'user_id', 'discount_vShop');
        if ($request->publish_id) {
            $products = $products->where('publish_id', 'like' . $request->publish_id . '%');
        }
        if ($request->category_id) {
            $products = $products->where('category_id', $request->category_id);
        }
        if ($request->order_by_id) {
            $products = $products->orderBy('id', $request->order_by_id);
        }
        if ($request->order_by_sold) {
            $products = $products->orderBy('amount_product_sold', $request->order_by_sold);
        }
        if ($request->order_by_price) {
            $products = $products->orderBy('price', $request->order_by_price);
        }
        if ($request->payments == 1) {
            $products = $products->where('prepay', 1);
        } elseif ($request->payments == 2) {
            $products = $products->where('payment_on_delivery', 1);
        }
        $products = $products->paginate($limit);
        foreach ($products as $value) {
            $img = json_decode($value->images);
            $value->images = asset($img[0]);
            $available_discount = BuyMoreDiscount::where('product_id', $value->id)->orderBy('id', 'desc')->first();
            if ($available_discount) {
                $value->available_discount = $available_discount->discount;
            }

//            return $available_discount;
//            available discount
        }

        return response()->json([
            'status_code' => 200,
            'data' => $products,

        ]);
    }

    /**
     * Danh sách sản phẩm nhà cung cấp
     *
     * API này sẽ trả về thông tin hiển thị sản phẩm nhà cung cấp
     *
     * @param Request $request
     * @param $id id nhà cung cấp
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam publish_id tìm kiếm theo mã sản phẩm mã sản phẩm
     * @urlParam category_id tìm kiếm theo danh mục
     * @urlParam order_by_price sắp xếp theo giá
     * @urlParam order_by_id sắp xếp theo id
     * @urlParam order_by_sold sắp xếp theo sl đã bán
     * @urlParam payments sắp xếp theo hình thức thanh toán 1 là COD 2 là trả trước
     * @return JsonResponse
     */
    public
    function productByNcc(Request $request, $id)
    {
        $limit = $request->limit ?? 10;
        $products = Product::where('user_id', $id)->where('status', 2)
            ->select('id', 'price', 'publish_id', 'category_id', 'name', 'images', 'discount_vShop as discount_vstore');
        if ($request->publish_id) {
            $products = $products->where('publish_id', 'like' . $request->publish_id . '%');
        }
        if ($request->category_id) {
            $products = $products->where('category_id', $request->category_id);
        }
        if ($request->order_by_id) {
            $products = $products->orderBy('id', $request->order_by_id);
        }
        if ($request->order_by_sold) {
            $products = $products->orderBy('amount_product_sold', $request->order_by_sold);
        }
        if ($request->order_by_price) {
            $products = $products->orderBy('price', $request->order_by_price);
        }
        if ($request->payments == 1) {
            $products = $products->where('prepay', 1);
        } elseif ($request->payments == 2) {
            $products = $products->where('payment_on_delivery', 1);
        }
        $products = $products->paginate($limit);
        foreach ($products as $value) {

            $value->images = asset(json_decode($value->images)[0]);
            $value->price_discount = $value->price - ($value->price / 100 * $value->discount_vstore);
            $value->available_discount = DB::table('discounts')->selectRaw('sum(discount) as sum ')->where('type', '!=', 3)
                    ->first()->sum ?? 0;

        }

        return response()->json([
            'status_code' => 200,
            'data' => $products,

        ]);
    }

    /**
     * Chi tiết sản phẩm
     *
     * API dùng để lấy chi tiết 1 sản phẩm
     *
     * @param  $id mã sản phẩm
     * @urlParam pdone_id
     * @return JsonResponse
     */
    public
    function productById(Request $request, $id)
    {

        $product = Product::where('id', $id)->select('publish_id', 'id', 'name', 'images', 'price', 'discount_vShop as discount_Vstore', 'video', 'description', 'user_id', 'category_id', 'amount_product_sold')->first();

        if (!$product) {
            return response()->json([
                'status_code' => 400,
                'data' => 'No product found or unapproved product',

            ], 400);
        }
        $img = [];
        foreach (json_decode($product->images) as $valimage) {
            $img[] = asset($valimage);
        }
        $product->images = $img;
//        return $product;
        $products_available = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND product_id =" . $product->id . " ) as amount FROM product_warehouses where status = 1 AND product_id = " . $product->id . ""))[0]->amount ?? 0;
        $product->products_available = $products_available;
        $product->available_discount = BuyMoreDiscount::Where('end', 0)->where('product_id', $product->id)->select('discount')->first()->discount;
        $product->rating = 5;
        //check đã tiếp thị hay chưa
        if ($request->pdone_id) {
            $check_vshop_product = VshopProduct::where('pdone_id', $request->pdone_id)->where('product_id', $id)->first();
            if ($check_vshop_product) {
                $product->affiliate = 1;
            } else {
                $product->affiliate = 0;
            }
        }
        $product->discount = 10;
        $product->price_discount = $product->price - ($product->price / 100 * 10);
        $list_vshop = VshopProduct::where('product_id', $id)->get();

        foreach ($list_vshop as $list) {
            $discount = Discount::where('product_id', $id)->where('user_id', $list->pdone_id)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->first();
            $list->vshop_discount = $discount->discount ?? 0;


        }


//        return $list_vshop;
        return response()->json([
            'status_code' => 200,
            'data' => $product,
            'list_vshop' => $list_vshop,
        ]);
    }

    /**
     * Vshop thêm sản phẩm
     *
     * API dùng để Vshop thêm sản phẩm
     *
     * @param Request $request
     * @param  $id mã sản phẩm
     * @bodyParam  pdone_id id của pdone
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function vshopPickup(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        $vshop = Vshop::select('pdone_id')->where('pdone_id', $request->pdone_id)->first();

        if (!$vshop) {
            $vshop = new Vshop();
            $vshop->pdone_id = $request->pdone_id;
            $vshop->save();
        }

        $checkVshop = DB::table('vshop_products')->select('id')->where('pdone_id', $vshop->id)->where('product_id', $id)->count();
        if ($checkVshop > 0) {
            return response()->json([
                'message' => 'Sản phẩm đã được đăng ký tiếp thị',
            ], 401);
        }
        try {
            DB::table('vshop_products')->insert([
                'pdone_id' => $vshop->pdone_id,
                'product_id' => $id,
                'status' => 1,
                'created_at' => Carbon::now()
            ]);
            return response()->json([
                'message' => 'Tiếp thị sản phẩm thành công',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }

    }

    /**
     * sản phẩm Vshop
     *
     * API lấy danh sách sản phẩm theo vshop
     *
     * @param Request $request
     * @param  $pdone_id  mã ID user V-Shop
     * @urlParam orderBy  id Mới nhất | amount_product_sold Bán chạy | price Giá
     * urlParam type  asc|desc Mặc định asc
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function productByVshop(Request $request, $pdone_id)
    {
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'asc';
        $data = null;
        $products = DB::table('vshop_products')
            ->select('name', 'publish_id', 'price', 'images', 'products.id', 'discount_vShop', 'amount_product_sold', 'view')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vshop_products.status', 1)
            ->where('pdone_id', $pdone_id);
        $total_product = $products->count();
        $products = $products->paginate($limit);
        foreach ($products as $pr) {
            $pr->discount = DB::table('discounts')
                    ->selectRaw('SUM(discount) as dis')
                    ->where('product_id', $pr->id)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->whereIn('type', [1, 2])
                    ->first()->dis ?? 0;
            $pr->image = asset(json_decode($pr->images)[0]);
            unset($pr->images);
            $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pr->id)->first()->max;
            $pr->available_discount = $more_dis ?? 0;
            $pr->vshop_discount = DB::table('discounts')
                    ->select('id', 'discount', 'start_date', 'end_date')->where('type', 3)->where('product_id', $pr->id)->where('user_id', $pdone_id)->first() ?? null;
        }
        return response()->json([
            'status_code' => 200,
            'total_product' => $total_product,
            'data' => $products
        ], 200);
    }

    public
    function getProductAvailableByVshop($pdone_id)
    {
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'asc';
        $data = null;
        $products = DB::table('vshop_products')
            ->select('name', 'publish_id', 'price', 'images', 'products.id', 'discount_vShop', 'amount_product_sold', 'vshop_products.amount as in_stock', 'view')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vshop_products.status', 2)
            ->where('pdone_id', $pdone_id);
        $total_product = $products->count();
        $products = $products->paginate($limit);
        foreach ($products as $pr) {
            $pr->discount = DB::table('discounts')
                    ->selectRaw('SUM(discount) as dis')
                    ->where('product_id', $pr->id)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->whereIn('type', [1, 2])
                    ->first()->dis ?? 0;
            $pr->image = asset(json_decode($pr->images)[0]);
            unset($pr->images);
            $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pr->id)->first()->max;
            $pr->available_discount = $more_dis ?? 0;
            $pr->vshop_discount = DB::table('discounts')
                    ->select('id', 'discount', 'start_date', 'end_date')->where('type', 3)->where('product_id', $pr->id)->where('user_id', $pdone_id)->first() ?? null;
        }
        return response()->json([
            'status_code' => 200,
            'total_product' => $total_product,
            'data' => $products
        ], 200);
    }

    /**
     * Tạo mới bill vãng lai
     *
     * API lấy danh sách sản phẩm để tạo bill vãng lai
     *
     * @param  $pdone_id  mã ID user V-Shop
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public
    function createBill($pdone_id)
    {
        $products = DB::table('vshop_products')
            ->select('products.id', 'images', 'products.name', 'vshop_products.amount')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vshop_products.status', 2)
            ->where('pdone_id', $pdone_id)
            ->where('vshop_products.amount', '>', 0)
            ->get();
        foreach ($products as $pr) {
            $pr->image = asset(json_decode($pr->images)[0]);

            unset($pr->images);
        }
        return response()->json([
            'status_code' => 200,
            'products' => $products
        ]);
    }

    public
    function saveBill($pdone_id, Request $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                [
                    'product_id' => 6,
                    'amount' => 7
                ]
            ];
            $bills = 0;
            $vstore = [];
            $vshop = [];
            $ncc = [];
            foreach ($request->infomation as $pro) {
                $products = DB::table('vshop_products')
                    ->where('pdone_id', $pdone_id)
                    ->where('product_id', $pro['product_id'])
                    ->where('amount', '>=', $pro['amount'])
                    ->count();
                if ($products == 0) {
                    return response()->json([
                        'status_code' => 400,
                        'message' => 'Sản phẩm không đủ số lượng'
                    ], 400);
                }
                $product = DB::table('products')
                    ->select('user_id', 'vstore_id', 'discount', 'discount_vShop', 'price')
                    ->where('status', 2)
                    ->where('id', $pro['product_id'])
                    ->first();
                $discount = DB::table('discounts')->where('start_date', '<=', Carbon::now())
                        ->selectRaw('SUM(discount) as dis')
                        ->where('end_date', '>=', Carbon::now())
                        ->where('product_id', $pro['product_id'])
                        ->whereIn('user_id', [$product->vstore_id, $product->user_id, $pdone_id])
                        ->first()
                        ->dis ?? 0;
                $price = ($product->price - ($product->price * $discount / 100));
                $bills += $price * $pro['amount'];
                $vstore[] = [
                    'total' => $price * $pro['amount'] * $product->discount / 100,
                    'vstore_id' => $product->vstore_id
                ];

                $vshop[] = [
                    'total' => $price * $pro['amount'] * $product->discount_vShop / 100,
                    'pdone_id' => $pdone_id
                ];

                $ncc[] = [
                    'total' => $price * $pro['amount'] - ($price * $pro['amount'] * $product->discount / 100) - ($price * $pro['amount'] * $product->discount_vShop / 100),
                    'ncc_id' => $product->user_id
                ];

            }

            return [$vstore, $vshop, $ncc, $bills];
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'status_code' => 500,
                'message' => $exception->getMessage()
            ]);
        }
    }


    public
    function mail()
    {
        $email = 'phungtheanh2001@gmail.com';
        Mail::send('email.email', ['ID' => '123123123', 'password' => '12121212'], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Đơn đăng ký của bạn đã được duyệt');

        });
    }

    /**
     * Vshop Nhập hàng sẵn
     *
     * API dùng để Vshop nhập hàng sẵn
     *
     * @param Request $request
     * @param  $id mã sản phẩm
     * @bodyParam amount số lượng sản phẩm
     * @bodyParam  pdone_id id của pdone
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function vshopReadyStock(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
            'amount' => 'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        DB::beginTransaction();
        try {
            $product = Product::where('id', $id)->where('status', 2)->first();
            if (!$product) {
                return response()->json([
                    'status_code' => 400,
                    'data' => 'Không tìm thấy sản phẩm',

                ], 400);
            }

            $vshop = Vshop::where('pdone_id', $request->pdone_id)->first();
            if (!$vshop) {
                return response()->json([
                    'status_code' => 400,
                    'data' => 'pdone_id chưa đăng ký thông tin nhận hàng',

                ], 400);
            }

            $bill = new Bill();
            $bill->name = $vshop->name;
            $bill->phone_number = $vshop->phone_number;
            $bill->pdone_id = $vshop->pdone_id;
            $bill->address = $vshop->address;
            $bill->save();


            $productWh = ProductWarehouses::where('product_id', $product->id)->where('status', 1)->groupBy('ware_id')->get();
            if (count($productWh) == 0) {
                return response()->json([
                    'status_code' => 400,
                    'data' => 'sẩn phẩm đã hết',

                ], 400);
            }
//        return $productWh;
            $ware_id = [];
            foreach ($productWh as $value) {
                $ware_id[] = $value->ware_id;

            }
            $warehouses = Warehouses::whereIn('id', $ware_id)->get();

            $address = $bill->address;
            $result = app('geocoder')->geocode($address)->get();
            $coordinates = $result[0]->getCoordinates();
            $lat = $coordinates->getLatitude();
            $long = $coordinates->getLongitude();

            foreach ($warehouses as $value) {
                $addressb = $value->address;
                $resultb = app('geocoder')->geocode($addressb)->get();
                $coordinatesb = $resultb[0]->getCoordinates();
                $latb = $coordinatesb->getLatitude();
                $longb = $coordinatesb->getLongitude();
                $value->distance = $this->haversineGreatCircleDistance($lat, $long, $latb, $longb);
            }
//            $warehouses= $warehouses->sortBy('distance','desc');
            $min = $warehouses[0];
            for ($i = 1; $i < count($warehouses); $i++) {
                if ($min->distance > $warehouses[$i]->distance) {
                    $min = $warehouses[$i];
                }
            }
            $buy_more = BuyMoreDiscount::where('start', '<=', $request->amount)
                ->where('end', '>', $request->amount)
                ->orWhere('end', 0)
                ->first();;
            if ($buy_more) {
                $price = $product->price - ($product->price / 100 * $buy_more->discount);
            } else {
                $price = $product->price;
            }


            $bill_detail = new BillDetail();
            while (true) {
                $codeBillDetail = 'vn-' . Str::random(12);
                if (!BillDetail::where('code', $codeBillDetail)->first()) {
                    $bill_detail->code = $codeBillDetail;
                    break;
                }
            }
            $bill_detail->bill_id = $bill->id;
            $bill_detail->ware_id = $min->id;
            $bill_detail->address = $vshop->address;
            $bill_detail->total = $price * $request->amount;
            $bill_detail->pick_up_address = $min->address;
            $bill_detail->save();
            $bill_product = new BillProduct();
            while (true) {
                $code = 'bill-' . Str::random(10);
                if (!BillProduct::where('code', $code)->first()) {
                    $bill_product->code = $code;
                    break;
                }
            }

            $bill_product->publish_id = $product->publish_id;
            $bill_product->vshop_id = null;
            $bill_product->quantity = $request->amount;
            $bill_product->price = $price;
            $bill_product->bill_detail_id = $bill_detail->id;
            $bill_product->vstore_id = $product->vstore_id;
            $bill_product->user_id = $product->user_id;
            $bill_product->product_id = $product->id;
            $bill_product->ware_id = $min->id;
            $bill_product->status = 1;
            $bill_product->save();

            $bill->total = $bill_product->price * $bill_product->quantity;
            $bill->save();


            $newProductWh = new ProductWarehouses();
            $newProductWh->code = $bill_product->code;
            $newProductWh->ware_id = $min->id;
            $newProductWh->product_id = $product->id;
            $newProductWh->status = 3;
            $newProductWh->amount = $request->amount;
            $newProductWh->bill_product_id = $bill_product->id;
            $newProductWh->save();
            $vshop_product = VshopProduct::where('pdone_id', $request->pdone_id)
                ->where('product_id', $id)->first();
            if ($vshop_product) {
                $vshop_product->status = 2;
                $vshop_product->amount += $request->amount;
                $vshop_product->save();
            } else {
                $newVshop_product = new VshopProduct();
                $newVshop_product->status = 2;
                $newVshop_product->amount = (int)$request->amount;
                $newVshop_product->pdone_id = $request->pdone_id;
                $newVshop_product->product_id = $id;
                $newVshop_product->save();
            }
            DB::commit();
            return response()->json([
                'status_code' => 200,
                'data' => $bill
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return ($e->getMessage());
        };

//        return $min;


    }

    public
    function haversineGreatCircleDistance(
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

    /**
     * Danh sách sản phẩm giảm giá siêu tốc
     *
     * API dùng để lấy danh sách sản phẩm giảm giá siêu tốc
     *
     * @param Request $request
     * @urlParam  limit Số lượng bản ghi 1 trang Mặc định 12
     * @urlParam  page Trang hiện tại hiển thị
     * @return \Illuminate\Http\JsonResponse
     */

    public
    function productSale(Request $request)
    {
        try {
            $limit = $request->limit ?? 12;
            $products = DB::table('products')
                ->selectRaw('images ,name, publish_id,price,products.id')
                ->join('discounts', 'products.id', '=', 'discounts.product_id')
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->whereIn('type', [1, 2])
                ->paginate($limit);
            foreach ($products as $pr) {
                $pr->sum_discount = DB::table('discounts')
                    ->selectRaw('SUM(discount) as sum')
                    ->where('product_id', $pr->id)
                    ->first()
                    ->sum;
                $pr->image = asset(json_decode($pr->images)[0]);
                unset($pr->images);
            }
            return response()->json(['status' => 200, 'data' => $products], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);

        }
    }

    /**
     * Hủy niêm yết sản phẩm của 1 V-shop
     *
     * API dùng để hủy niêm yết sản phẩm của V-shop
     *
     * @param $pdone_id ID user vshop
     * @param $product_id ID sản phẩm
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function destroyAffProduct($pdone_id, $product_id)
    {
        try {
            DB::table('vshop_products')->where('pdone_id', $pdone_id)->where('product_id', $product_id)->where('status', 1)->update(['status' => 3]);

            return response()->json([
                'status_code' => 201,
                'message' => 'Hủy niêm yết sản phẩm thành công'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
