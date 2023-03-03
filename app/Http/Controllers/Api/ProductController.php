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
     * @urlParam order_by | 1 Sắp xếp mới nhất | 2 Sắp xếp theo giá | 3 Số sản phẩm đã bán
     * @urlParam option 1 asc | 2 desc
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 10
     * @urlParam payment Phương thức thanh toán 1 COD | 2 Chuyển khoản
     * @urlParam publish_id mã sản phẩm
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        $limit = $request->limit ?? 10;
        $publish_id = $request->publish_id ?? '';
        $products = Product::where('vstore_id', '!=', null)->where('status', 2)->where('publish_id', '!=', null)->where('publish_id', 'like', '%' . $publish_id . '%')
            ->select('id', 'name', 'publish_id', 'images', 'price', 'discount_vShop as discount_vstore');
        if ($request->category_id) {
            $products = $products->where('category_id', $request->category_id);
        }
        if ($request->order_by == 1) {
            $order_by = $request->option == 1 ? 'asc' : 'desc';
            $products = $products->orderBy('id', $order_by);
        }
        if ($request->order_by == 2) {
            $order_by_price = $request->option == 1 ? 'asc' : 'desc';
            $products = $products->orderBy('price', $order_by_price);
        }
        if ($request->order_by == 3) {
            $order_by_sold = $request->option == 1 ? 'asc' : 'desc';
            $products = $products->orderBy('amount_product_sold', $order_by_sold);
        }
        if ($request->payment) {
            if ($request->payment == 1) {
                $products = $products->where('payment_on_delivery', 1);

            } else {
                $products = $products->where('prepay', 1);
            }
        }
        $products = $products->paginate($limit);

        foreach ($products as $pro) {
            $pro->images = asset(json_decode($pro->images)[0]);
            $pro->price_discount = $pro->price - ($pro->price / 100 * $pro->discount_vstore);
            $pro->available_discount = DB::table('discounts')->selectRaw('sum(discount) as sum ')->where('type', '!=', 3)
                    ->first()->sum ?? 0;

//
        }
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
    public function productByCategory(Request $request, $id)
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
    public function productByVstore(Request $request, $id)
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
    public function productByNcc(Request $request, $id)
    {
        $limit = $request->limit ?? 10;
        $products = Product::where('user_id',$id)->where('status', 2)
            ->select('id','price', 'publish_id','category_id', 'name', 'images','discount_vShop as discount_vstore');
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
            $value->price_discount = $value->price -($value->price/100 * $value->discount_vstore);
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
     *
     * @return JsonResponse
     */
    public function productById($id)
    {

        $product = Product::where('publish_id', $id)->select('publish_id', 'id', 'name', 'images', 'price', 'discount_vShop', 'video')->first();

        if (!$product) {
            return response()->json([
                'status_code' => 400,
                'data' => 'No product found or unapproved product',

            ], 400);
        }
        $products_available = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND product_id =" . $product->id . " ) as amount FROM product_warehouses where status = 1 AND product_id = " . $product->id . ""))[0]->amount ?? 0;
        $product->products_available = $products_available;
        return response()->json([
            'status_code' => 200,
            'data' => $product,

        ]);
    }

    /**
     * Vshop thêm sản phẩm
     *
     * API dùng để Vshop thêm sản phẩm
     *
     * @param Request $request
     * @param  $id mã sản phẩm
     * @bodyParam  id_pdone id của pdone
     * @return \Illuminate\Http\JsonResponse
     */
    public function vshopPickup(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        $vshop = Vshop::select('id_pdone')->where('id_pdone', $request->id_pdone)->first();

        if (!$vshop) {
            $vshop = new Vshop();
            $vshop->id_pdone = $request->id_pdone;
            $vshop->save();
        }

        $checkVshop = DB::table('vshop_products')->select('id')->where('id_pdone', $vshop->id)->where('product_id', $id)->count();
        if ($checkVshop > 0) {
            return response()->json([
                'message' => 'Sản phẩm đã được đăng ký tiếp thị',
            ], 401);
        }
        try {
            DB::table('vshop_products')->insert([
                'id_pdone' => $vshop->id_pdone,
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
     * @param  $id  id_pdone
     * @urlParam orderBy  id Mới nhất | amount_product_sold Bán chạy | price Giá
     * urlParam type  asc|desc Mặc định asc
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function productByVshop(Request $request, $id)
    {
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'asc';
        $vshop = DB::table('vshop_products')
            ->select('name', 'publish_id', 'price', 'images', 'products.id', 'category_id')
            ->join('products', 'vshop_products.product_id', '=', 'products.id')
            ->where('id_pdone', $id);
        $data = [];
        $category = [];


        $data['info']['total_product'] = $vshop->count();
        foreach ($vshop->groupBy(['name', 'publish_id', 'price', 'images', 'products.id', 'category_id'])->get() as $a) {
            $category[] = DB::table('categories')->select('name')->where('id', $a->category_id)->first()->name;
        }
        $data['info']['categories'] = implode(', ', array_unique($category));
        $data['products'] = $vshop;
        if ($request->orderBy) {
            $data['products'] = $data['products']->orderBy($request->orderBy, $type);
        }
        $data['products'] = $data['products']->paginate($limit);
        foreach ($data['products'] as $v) {
            $v->discount = DB::table('discounts')->selectRaw('SUM(discount) as dis')->where('end_date', '>=', Carbon::now())->where('product_id', $v->id)->first()->dis ?? 0;
            $v->image = asset(json_decode($v->images)[0]);
            unset($v->images);
            unset($v->category_id);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function mail()
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
     * @bodyParam  id_pdone id của pdone
     * @return \Illuminate\Http\JsonResponse
     */
    public function vshopReadyStock(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
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

            $vshop = Vshop::where('id_pdone', $request->id_pdone)->first();
            if (!$vshop) {
                return response()->json([
                    'status_code' => 400,
                    'data' => 'id_pdone chưa đăng ký thông tin nhận hàng',

                ], 400);
            }

            $bill = new Bill();
            $bill->name = $vshop->name;
            $bill->phone_number = $vshop->phone_number;
            $bill->id_pdone = $vshop->id_pdone;
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
            $vshop_product = VshopProduct::where('id_pdone', $request->id_pdone)
                ->where('product_id', $id)->first();
            if ($vshop_product) {
                $vshop_product->status = 2;
                $vshop_product->amount += $request->amount;
                $vshop_product->save();
            } else {
                $newVshop_product = new VshopProduct();
                $newVshop_product->status = 2;
                $newVshop_product->amount = (int)$request->amount;
                $newVshop_product->id_pdone = $request->id_pdone;
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

    public function productSale(Request $request)
    {
        try {
            $limit = $request->limit ?? 12;
            $products = DB::table('products')
                ->selectRaw('images ,name, publish_id,price,products.id')
                ->join('discounts', 'products.id', '=', 'discounts.product_id')
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '<=', Carbon::now())
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
}
