<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\UseStatementPass;
use Illuminate\Support\Facades\Validator;


/**
 * @group Manufacture
 *
 * Danh sách api liên quan nhà cung cấp
 */
class ManufactureController extends Controller
{

    public function searchManufacturesByKeyword(Request $request) {

        $validator = Validator::make($request->all(), [
            'key_word' => 'required'
        ],
            [
                'key_word.required' => 'Từ khóa tìm kiếm không được để trông'
            ]
        );

        $limit = $request->limit ?? 12;
        $elasticsearchController = new ElasticsearchController();
        $res = $elasticsearchController->searchDocNCC($request->key_word);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::where('role_id', 2)->where('account_code', '!=', null)
            ->whereIn('id', $res)
            ->where('status', '!=', 0)
            ->select('id', 'name', 'avatar');

        $user = $user->paginate($limit);
        if ($user) {
            foreach ($user as $value) {
                if ($value->avatar == null) {
                    $value->avatar = asset('home/img/NCC.png');
                } else
                    $value->avatar = asset('image/users/' . $value->avatar);

            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,
        ]);
    }

    /**
     * Danh sách nhà cung cấp
     *
     * API này sẽ trả về sách Nhà cung cấp
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang | Mặc định 100 bản ghi
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 100;
        $user = User::where('role_id', 2)->where('account_code', '!=', null)
            ->select('id', 'name', 'avatar')
            ->paginate($limit);

        if ($user) {
            foreach ($user as $value) {
                $value->avatar = strlen($value->avatar) == 0 ? asset('home/img/ncc11.png') : asset('image/users/' . $value->avatar);
            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }




    /**
     * chi tiết nhà cung cấp
     *
     * API này sẽ trả về thông tin nhà cung cấp
     *
     * @param $ncc_id id nhà cung cấp
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileNCC($ncc_id)
    {

        try {

            $user = User::select('avatar','name', 'id', 'account_code', 'description', 'phone_number')->where('role_id', 2)->where('id', $ncc_id)->first();
           if ($user){
               $user->total_product = $user->products()->where('status', 2)->count();
                $user->avatar = ($user->avatar !='') ? asset('image/users/'.$user->avatar): asset('home/img/NCC.png');
               $cate = Category::select('categories.name')
                   ->join('products', 'categories.id', '=', 'products.category_id')
                   ->where('user_id', $ncc_id)
                   ->where('products.status',2)
                   ->groupBy('categories.name')
                   ->get();
               $products = Product::select('images')->where('user_id', $ncc_id)->where('status', 2)->limit(5)->get();
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
               $user->categories = implode(', ', $data);

               return response()->json([
                   'status' => 200,
                   'data' => $user
               ]);
           }

        } catch (\Exception $e) {

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
