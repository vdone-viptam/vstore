<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Categories
 *
 * Danh sách api liên quan tới danh mục
 */
class CategoryController extends Controller
{
    /**
     * Danh sách danh mục
     *
     * API này sẽ trả về danh sách danh mục
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 48
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 48;
        try {
            $categories = Category::select('id', 'name', 'img')->paginate($limit);
            if ($categories) {
                foreach ($categories as $value) {
                    $value->img = asset($value->img);
                }
            }
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Danh sách danh mục theo V-Store
     *
     * API này sẽ trả về danh sách danh mục theo vstore được chọn
     *
     * @param Request $request
     * @param Request $vstore_id example
     * @urlParam limit Giới hạn bản ghi  Mặc định 100
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryByVstore($vstore_id, Request $request)
    {
        try {
            $limit = $request->limit ?? 100;
            $products = Product::select('category_id')->where('status', 2)->where('vstore_id', $vstore_id)->get();
            $data = [];

            foreach ($products as $pr) {
                $data[] = $pr->category_id;
            }
            $category = Category::select('id', 'name', 'img')->whereIn('id', $data)->where('status', 1)->limit($limit)->get();
            if ($category) {
                foreach ($category as $value) {
                    $value->img = asset($value->img);
                }
            }
            return response()->json(['status' => 200, 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()], 400);

        }


    }

    /**
     * Chi tiết danh mục
     *
     * API này sẽ trả về danh sách sản phẩm theo danh mục và các Vstore niêm yết sản phẩm thuộc danh mục đó
     *
     * @param Request $request
     * @param $category_id
     * @urlParam pdone_id Id user Vshop (truyền khi user đang đăng nhập là đang là VSHOP)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductAndVstoreByCategory(Request $request, $category_id)
    {
        try {

            $limit = $request->limit ?? 8;
            $product = Product::select('images', 'name', 'publish_id', 'price', 'id', 'vstore_id')
                ->where('category_id', $category_id)
                ->where('status', 2);

            $product = $product->limit(8)->get();

            $data_vstore = [];

            foreach ($product as $pr) {
                $pr->discount = DB::table('discounts')
                        ->selectRaw('SUM(discount) as sum')
                        ->where('product_id', $pr->id)
                        ->whereIn('type', [1, 2])
                        ->first()->sum ?? 0;

                $pr->image = asset(json_decode($pr->images)[0]);
                unset($pr->images);
                $data_vstore[] = $pr->vstore_id;
                unset($pr->vstore_id);
                if ($request->pdone_id) {
                    $pr->is_affiliate = DB::table('vshop_products')->where('product_id', $pr->id)->where('pdone_id', $request->pdone_id)->count();
                    $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pr->id)->first()->max;
                    $pr->available_discount = $more_dis ?? 0;
                }
            }
            $users = User::select('id', 'name', 'avatar')->whereIn('id', $data_vstore)->limit(8)->get();
            foreach ($users as $user) {
                $user->avatar = asset('image/users/' . $user->avatar);
            }
            return response()->json(['success' => true, 'data' => [
                'vstores' => $users,
                'products' => $product
            ]]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);

        }

    }

    /**
     * Danh sách sản phẩm theo danh mục
     *
     * API này sẽ trả về danh sách sản phẩm theo danh mục
     *
     * @param Request $request
     * @param $category_id id danh mục
     * @urlParam pdone_id Id user Vshop (truyền khi user là đang đăng nhập là VSHOP)
     * @urlParam orderById Sắp sếp sản phẩm mới nhất asc|desc Mặc định asc VD: orderById=asc
     * @urlParam amount_product_sold Sắp sếp sản phẩm bán chạy asc|desc VD: amount_product_sold=desc
     * @urlParam orderByPrice Sắp sếp theo giá sản phẩm asc|desc VD: orderByPrice=asc
     * @urlParam paymentMethod Phương thức thanh toán 1 COD | 2 Chuyển khoản
     * @urlParam page Trang hiện tại
     * @urlParam limit Giới hạn bản ghi 1 trang
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByCategory(Request $request, $category_id)
    {
        try {
            $limit = $request->limit ?? 8;
            $product = Product::select('images', 'name', 'publish_id', 'price', 'id')
                ->where('category_id', $category_id)
                ->where('status', 2);

            if ($request->orderById) {
                $product = $product->orderBy('id', $request->orderById);
            }
            if ($request->amount_product_sold) {
                $product = $product->orderBy('amount_product_sold', $request->amount_product_sold);
            }
            if ($request->orderByPrice) {
                $product = $product->orderBy('price', $request->orderByPrice);
            }
            if ($request->paymentMethod) {
                if ($request->paymentMethod == 1) {
                    $product = $product->where('payment_on_delivery', 1);
                }
                if ($request->paymentMethod == 2) {
                    $product = $product->where('prepay', 1);
                }
            }
            $product = $product->paginate($limit);


            foreach ($product as $pr) {
                $pr->discount = DB::table('discounts')
                        ->selectRaw('SUM(discount) as sum')
                        ->where('product_id', $pr->id)
                        ->whereIn('type', [1, 2])
                        ->first()->sum ?? 0;

                $pr->image = asset(json_decode($pr->images)[0]);
                unset($pr->images);
                if ($request->pdone_id) {
                    $pr->is_affiliate = DB::table('vshop_products')->where('product_id', $pr->id)->where('pdone_id', $request->pdone_id)->count();
                    $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pr->id)->first()->max;
                    $pr->available_discount = $more_dis ?? 0;
                }
            }

            return response()->json(['success' => true, 'data' => $product]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Danh sách tất cả vstore tiếp thị sản phẩm có danh mục được chọn
     *
     * API này sẽ trả về danh sách tất cả vstore tiếp thị sản phẩm có danh mục được chọn
     *
     * @param Request $request
     * @param $category_id ID danh mục
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllVstoreByCategory($category_id)
    {
        try {
            $users = Product::select('avatar', 'users.name', 'users.id')
                ->join('users', 'products.vstore_id', '=', 'users.id')
                ->where('category_id', $category_id)
                ->groupBy(['avatar', 'users.name', 'users.id'])
                ->get();
            foreach ($users as $user) {
                $user->avatar = asset('image/users/' . $user->avatar);
            }
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

}
