<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function index(Request $request) {

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
        $limit = $request->limit ?? 12;
        $els = new ElasticsearchController();
        $dataSearch = $els->searchAll($request->key_word);

        $vstore_products = [];
        $supplier = [];
        $vstore_categories = [];
        $vshop = [];
        foreach ($dataSearch as $item) {
            if ($item['_index'] == 'vstore_products') {
                $vstore_products[] = $item['_id'];
            } elseif ($item['_index'] == 'supplier') {
                $supplier[] = $item['_id'];
            } elseif ($item['_index'] == 'vstore_categories') {
                $vstore_categories[] = $item['_id'];
            } elseif ($item['_index'] == 'vshop') {
                $vshop[] = $item['_id'];
            }
        }
        $products = Product::where('vstore_id', '!=', null)->where('status', 2)->where('publish_id', '!=', null)
            ->where('availability_status', 1)->whereIn('id', $vstore_products);
        $selected = ['id', 'name', 'publish_id', 'images', 'price', 'category_id', 'type_pay'];
        $request->option = $request->option == 'asc' ? 'asc' : 'desc';
        if ($request->pdone_id) {
            $selected[] = 'discount';
            $selected[] = 'discount_vShop as discountVstore';
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
        if ($request->type_pay) {
            $products = $products->where('type_pay', $request->type_pay);
        }
        $products = $products->orderBy('products.id', 'desc')->get();
        foreach ($products as $pro) {
            $pro->images = asset(json_decode($pro->images)[0]);
            $pro->discount = round(DB::table('discounts')->selectRaw('sum(discount) as sum')->where('product_id', $pro->id)
                ->whereIn('type', [1, 2])
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->first()->sum ?? 0, 2);
            if ($request->pdone_id) {
                $pro->is_affiliate = Vshop::join('vshop_products', 'vshop.id', '=', 'vshop_products.vshop_id')
                    ->where('product_id', $pro->id)
                    ->whereIn('vshop_products.status', [1, 2])
                    ->where('vshop.pdone_id', $request->pdone_id)
                    ->count() ?? 0;
                $pro->is_affiliate = $pro->is_affiliate > 0 ? 1 : 0;

                $more_dis = DB::table('buy_more_discount')->selectRaw('MAX(discount) as max')->where('product_id', $pro->id)->first()->max;
                $pro->available_discount = $more_dis ?? 0;
            }
        }


        $categories = Category::where('status', 1)
            ->whereIn('id', $vstore_categories)
            ->select('id', 'name', 'img')->get();

        if ($categories) {
            foreach ($categories as $value) {
                if ($value->img == null) {
                    $value->img = asset('home/img/logo-06.png');
                } else {
                    $value->img = asset($value->img);
                }
            }
        }

        $supplier = User::where('role_id', 2)->where('account_code', '!=', null)
            ->whereIn('id', $supplier)
            ->where('status', '!=', 0)
            ->select('id', 'name', 'avatar')->get();

        if ($supplier) {
            foreach ($supplier as $value) {
                if ($value->avatar == null) {
                    $value->avatar = asset('home/img/NCC.png');
                } else
                    $value->avatar = asset('image/users/' . $value->avatar);
            }
        }


        $vstore = User::where('role_id', 3)->where('account_code', '!=', null)
            ->whereIn('id', $vstore_products)
            ->where('status', '!=', 0)
            ->select('id', 'name', 'avatar')->get();

        if ($vstore) {
            foreach ($vstore as $value) {
                if ($value->avatar == null) {
                    $value->avatar = asset('home/img/logo-06.png');
                } else
                    $value->avatar = asset('image/users/' . $value->avatar);

            }
        }


        $vshop = Vshop::whereIn('id', $vshop)
            ->select('pdone_id as id', 'nick_name', 'avatar')->get();

        if ($vshop) {
            foreach ($vshop as $value) {
                if ($value->avatar == null) {
                    $value->avatar = asset('home/img/logo-06.png');
                } else
                    $value->avatar = $value->avatar;

            }
        }

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'supplier' => $supplier,
            'vstore' => $vstore,
            'vshop' => $vshop
        ]);

    }
}
