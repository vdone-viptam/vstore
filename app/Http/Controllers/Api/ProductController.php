<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BuyMoreDiscount;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam publish_id mã sản phẩm
     * @return JsonResponse
     */
    public function index(Request $request)
    {

        $limit = $request->limit ?? 10;
        $publish_id = $request->publish_id ?? '';
        $products = Product::where('vstore_id', '!=', null)->where('status', 2)->where('publish_id', '!=', null)->where('publish_id', 'like', '%' . $publish_id . '%')->paginate($limit);
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
        $products = Product::where('user_id', $id)->where('status', 2)
            ->select('id', 'publish_id', 'discount', 'name', 'category_id', 'images', 'vstore_id', 'user_id');
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
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @param  $id mã sản phẩm
     * @bodyParam  id_pdone id của pdone
     * @return \Illuminate\Http\JsonResponse
     */
    public function vshopPickup(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
            'id' => 'required|exists:products,id'
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
                'vshop_id' => $vshop->id,
                'product_id' => $id,
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

}
