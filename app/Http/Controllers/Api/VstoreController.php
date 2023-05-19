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
//        return 1;
        $validator = Validator::make($request->all(), [

            'branch' => 'numeric|min:1|max:2',

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }
        $limit = $request->limit ?? 10;
        if ($request->branch == 2) {
            $user = User::where('role_id', 3)->where('account_code', '!=', null)
                ->where('branch', $request->branch)
                ->where('status', '!=', 0)
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


        } elseif ($request->branch == 1) {

            $user = User::where('role_id', 3)->where('account_code', '!=', null)->where('status', '!=', 0)->where('branch', '!=', 2)
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

        } else {
            $user = User::where('role_id', 3)->where('account_code', '!=', null)
//                ->where('branch', 2)
                ->where('status', '!=', 0)
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
        }

//        return $user->get();
        $user = $user->paginate($limit);
        if ($user) {
            foreach ($user as $value) {
                if ($value->avatar == null) {
                    $value->avatar = asset('home/img/vstore-vuong.png');
                } else
                    $value->avatar = asset('image/users/' . $value->avatar);

            }

//                $value->avatar != null ? asset($value->avatar):;

        }
//
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
            ->where('products.availability_status', 1)
            ->where('categories.id', $id)
            ->select('users.id', 'users.name', 'users.avatar')
            ->paginate($limit);
        foreach ($vstores as $value) {
            if ($value->avatar != '') {
                $value->avatar = asset('image/users/' . $value->avatar);
            } else {
                $value->avatar = asset('home/img/logo-06.png');
            }

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
            $user = User::select('name', 'id', 'account_code', 'description', 'phone_number', 'avatar')->where('role_id', 3)->where('id', $id)->first();
            if ($user->avatar == null) {
                $user->avatar = asset('home/img/vstore-vuong.png');
            } else {
                $user->avatar = asset('image/users/' . $user->avatar);
            }
//            $user->total_product = $user->products()->where('status', 2)->count();
            $user->total_product = Product::where('vstore_id', $user->id)->where('availability_status',1)
                ->where('status', 2)->count();

            $cate = Category::select('categories.name')
                ->join('products', 'categories.id', '=', 'products.category_id')
                ->where('vstore_id', $id)
                ->where('products.status', 2)
                ->groupBy('categories.name')
                ->get();
            $data = [];
            foreach ($cate as $c) {
                $data[] = $c->name;
            }

            $user->categories = implode(', ', $data);
            $products = Product::select('images')->where('vstore_id', $id)->where('availability_status',1)->where('status', 2)->limit(5)->get();
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

    /**
     * Danh sách V-Store có tên chứa từ khóa tìm kiếm
     *
     * API này sẽ trả về danh sách vstore
     *
     * @urlParam  key_word id user
     * @return JsonResponse
     */

    public function searchVstoreByKeyword(Request $request)
    {
        $limit = $request->limit ?? 12;
        $elasticsearchController = new ElasticsearchController();
        $res = $elasticsearchController->searchDocVStore($request->key_word);
        $validator = Validator::make($request->all(), [
            'key_word' => 'required'
        ],
            [
                'key_word.required' => 'Từ khóa tìm kiếm không được để trông'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()
            ], 400);
        }
        $user = User::where('role_id', 3)->where('account_code', '!=', null)
            ->whereIn('id', $res)
            ->where('status', '!=', 0)
            ->select('id', 'name', 'avatar');

        $user = $user->paginate($limit);
        if ($user) {
            foreach ($user as $value) {
                if ($value->avatar == null) {
                    $value->avatar = asset('home/img/logo-06.png');
                } else
                    $value->avatar = asset('image/users/' . $value->avatar);

            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,
        ]);
    }
}
