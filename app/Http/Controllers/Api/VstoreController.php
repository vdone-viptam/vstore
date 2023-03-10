<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Vstore
 *
 * Danh sách api liên quan nhà phân phối vstore
 */
class VstoreController extends Controller
{



    //
    /**
     * Danh sách nhà vstore
     *
     * API này sẽ trả về sách vstore
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam branch 1 là vstore thường, 2 là vstore cấp 1 (địa phương)
     * @urlParam account_code tìm kiếm mã vstore
     * @urlParam name tìm kiếm mã name
     * @urlParam company_name tìm kiếm mã tên công ty
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'branch' => 'numeric|min:1|max:2',

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }
        $limit = $request->limit ?? 10;
        if ($request->branch) {
            $user = User::where('role_id', 3)->where('account_code', '!=', null)
                ->where('branch', $request->branch)
                ->select('id', 'name', 'company_name', 'phone_number', 'tax_code', 'address', 'account_code', 'avatar', 'branch');
            if ($request->account_code) {
                $user = $user->where('account_code', 'like', '%' . $request->account_code . '%');
            }
            if ($request->name) {
                $user = $user->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->company_name) {
                $user = $user->where('company_name', 'like', '%' . $request->company_name . '%');
            }
            $user = $user->paginate($limit);


        } else {

            $user = User::where('role_id', 3)->where('account_code', '!=', null)
                ->select('id', 'name', 'company_name', 'phone_number', 'tax_code', 'address', 'account_code', 'avatar', 'branch');
            if ($request->account_code) {
                $user = $user->where('account_code', 'like', '%' . $request->account_code . '%');
            }
            if ($request->name) {
                $user = $user->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->company_name) {
                $user = $user->where('company_name', 'like', '%' . $request->company_name . '%');
            }
            $user = $user->paginate($limit);
        }
        if ($user) {
            foreach ($user as $value) {
                $value->avatar = asset($value->avatar);
            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);

    }

    /**
     * Danh sách vstore danh mục
     *
     * API này sẽ trả về sách vstore có sản phẩm trong danh mục
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @return JsonResponse
     */
    public function listByCategory(Request $request, $id)
    {
        $limit = $request->limit ?? 10;
        $vstores = User::join('products', 'users.id', '=', 'products.vstore_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.id', $id)
            ->select('users.id', 'users.name', 'users.avatar')
            ->paginate($limit);
        foreach ($vstores as $value) {
            $value->avatar = asset('image/users/' . $value->avatar);
        }
        return response()->json([
            'status_code' => 200,
            'data' => $vstores,

        ]);
    }

    /**
     * chi tiết vstore
     *
     * API này sẽ trả về chi tiết vstore
     *
     * @param $id id user
     * @return JsonResponse
     */
    public function detail($id)
    {

        try {
            $user = User::select('name', 'id', 'account_code', 'description', 'phone_number')->where('role_id', 3)->where('id', $id)->first();
            $user->total_product = $user->products()->where('status', 2)->count();
            $cate = Category::select('categories.name')
                ->join('products', 'categories.id', '=', 'products.category_id')
                ->where('vstore_id', $id)
                ->groupBy('categories.name')
                ->get();
            $data = [];
            foreach ($cate as $c) {
                $data[] = $c->name;
            }

            $user->categories = implode(', ', $data);
            $products = Product::select('images')->where('vstore_id', $id)->where('status', 2)->limit(5)->get();
            $images = [];
            for ($i = 0; $i < count($products); $i++) {
                $images[] = asset(json_decode($products[$i]->images)[0]);
            }
            $data = [];
            foreach ($cate as $c) {
                $data[] = $c->name;
            }
            $user->description = [
                'text' => $user->description,
                'images' => $images
            ];
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
