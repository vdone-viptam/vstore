<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LandingpageController extends Controller
{
    public function index($slug)
    {
//        return 1;
        $user = User::where('slug', $slug)
            ->where('role_id', 2)
            ->first();
        if ($user) {

            $logo = !empty($user->avatar) ? $user->avatar : '';
            $banner = !empty($user->banner) ? $user->banner : '';
            $name = $user->name ?? '';
            $category = Product::select("category_id")->where('products.user_id', $user->id)->where('availability_status', 1)->groupBy('category_id')->get();
//            $category= Category::all();
//            return $category;
            $arrCategory = [];
            foreach ($category as $cate) {
                $arrCategory[] = $cate->category_id;
            }
            $arrCategory = Category::whereIn('id', $arrCategory)->get();
            $count_products = Product::where('status', 2)->where('availability_status', 1)->where('user_id', $user->id)->count();
            $fiveImage = Product::select('images')->where('availability_status', 1)->where('status', 2)->where('user_id', $user->id)->get();
        } else {
            return redirect(route('landingpagencc'));
        }
        $big_sale = DB::table('products')
            ->where('availability_status', 1);
        $selected = [DB::raw('SUM(discounts.discount) as discount'), 'products.id', 'images', 'publish_id', 'price', 'products.name', DB::raw("price - (price * IFNULL((SELECT SUM(discount /100) as dis
                        FROM discounts WHERE start_date <= '" . \Illuminate\Support\Carbon::now() . "' and end_date >= '" . Carbon::now() . "'
                                        AND product_id = products.id AND type != 3 GROUP BY product_id ),0)) as order_price"), DB::raw("(SELECT ROUND( IFNULL(AVG(point_evaluation),0),1) FROM points WHERE product_id = products.id) as vote")];
        $big_sale = $big_sale->select($selected)->join('discounts', 'products.id', '=', 'discounts.product_id')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->whereIn('type', [1, 2])
            ->groupBy('products.id')
            ->where('products.status', 2)
            ->where('products.user_id', $user->id)
            ->having('discount', '>=', 30)
            ->get();
        $hot_products = DB::table('products')
            ->where('availability_status', 1);
        $selected = ['products.id', 'images', 'publish_id', 'price', 'products.name', DB::raw("(SELECT ROUND( IFNULL(AVG(point_evaluation),0),1) FROM points WHERE product_id = products.id) as vote")];
        $hot_products = $hot_products->select($selected)
            ->selectSub("SELECT SUM(discount)
                        FROM discounts WHERE start_date <= '" . \Illuminate\Support\Carbon::now() . "' and end_date >= '" . \Illuminate\Support\Carbon::now() . "'
                                        AND product_id = products.id AND discounts.type != 3 GROUP BY product_id", 'discount_sale')
            ->groupBy('products.id')
            ->where('products.user_id', $user->id)
            ->orderBy('amount_product_sold', 'desc')
            ->where('products.status', 2)
            ->paginate(18);
        $vstore = User::join('products', 'users.id', '=', 'products.vstore_id')
            ->where('products.user_id', $user->id)
            ->groupBy('products.vstore_id')
            ->where('role_id', 3)
            ->select('users.name', 'users.avatar', 'users.slug')
            ->get();
        return view('screens.landingpage', compact('logo', 'hot_products', 'name', 'user', 'arrCategory', 'user', 'count_products', 'big_sale', 'vstore', 'fiveImage'));
    }

    public function ladingpage()
    {
        return view('screens.vstore.index');
    }

    public function ladingpageNCC(Request $request)
    {
        $user = false;
        $order = false;
        if ($request->order && $request->user) {
            $user = User::find($request->user);
            if ($user) {
                if ($user->referral_code != '') {
                    $vshop = Vshop::where('pdone_id', $user->referral_code)->orWhere('vshop_id', $user->referral_code)->first();
                    if ($vshop) {
                        $respn = Http::post(config('domain.domain_vdone') . 'notifications/' . $vshop->pdone_id, [
                            'message' => $user->name . ' đã mua tài khoản thành công',
                            'productId' => 1,
                            'orderId' => 1,
                            'type' => 9,

                        ]);
                    }

                }
            }

            $order = OrderService::find($request->order);
        }

        return view('screens.manufacture.index', compact(['user', 'order']));
    }

    public function ladingpageStorage(Request $request)
    {
        $user = false;
        $order = false;
        if ($request->order && $request->user) {
            $user = User::find($request->user);
            if ($user) {
                if ($user->referral_code != '') {
                    $vshop = Vshop::where('pdone_id', $user->referral_code)->orWhere('vshop_id', $user->referral_code)->first();
                    if ($vshop) {
                        $respn = Http::post(config('domain.domain_vdone') . 'notifications/' . $vshop->pdone_id, [
                            'message' => $user->name . ' đã mua tài khoản thành công',
                            'productId' => 1,
                            'orderId' => 1,
                            'type' => 9,

                        ]);
                    }

                }
            }
            $order = OrderService::find($request->order);
        }

        return view('screens.storage.index', compact(['user', 'order']));
    }

    public function vstore($slug)
    {
        $user = User::where('slug', $slug)
            ->where('role_id', 3)
            ->first();
        if ($user) {

            $logo = !empty($user->avatar) ? $user->avatar : '';
            $banner = !empty($user->banner) ? $user->banner : '';
            $name = $user->name ?? '';
            $category = Product::select("category_id")->where('products.vstore_id', $user->id)->where('availability_status', 1)->groupBy('category_id')->get();
//            $category= Category::all();
//            return $category;
            $arrCategory = [];
            foreach ($category as $cate) {
                $arrCategory[] = $cate->category_id;
            }
            $arrCategory = Category::whereIn('id', $arrCategory)->get();
            $count_products = Product::where('status', 2)->where('availability_status', 1)->where('vstore_id', $user->id)->count();
            $fiveImage = Product::select('images')->where('availability_status', 1)->where('status', 2)->where('vstore_id', $user->id)->get();
        } else {
            return redirect(route('landingpagencc'));
        }
        $big_sale = DB::table('products')
            ->where('availability_status', 1);
        $selected = ['products.id', DB::raw('SUM(discounts.discount) as discount'), 'images', 'publish_id', 'price', 'products.name', DB::raw("price - (price * IFNULL((SELECT SUM(discount /100) as dis
                        FROM discounts WHERE start_date <= '" . \Illuminate\Support\Carbon::now() . "' and end_date >= '" . Carbon::now() . "'
                                        AND product_id = products.id AND type != 3 GROUP BY product_id ),0)) as order_price"), DB::raw("(SELECT ROUND( IFNULL(AVG(point_evaluation),0),1) FROM points WHERE product_id = products.id) as vote")];
        $big_sale = $big_sale->select($selected)->join('discounts', 'products.id', '=', 'discounts.product_id')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->whereIn('type', [1, 2])
            ->groupBy('products.id')
            ->where('products.vstore_id', $user->id)
            ->where('products.status', 2)
            ->having('discount', '>=', 30)
            ->get();
        $hot_products = DB::table('products')
            ->where('availability_status', 1);
        $selected = ['products.id', 'images', 'publish_id', 'price', 'products.name', DB::raw("(SELECT ROUND( IFNULL(AVG(point_evaluation),0),1) FROM points WHERE product_id = products.id) as vote")];
        $hot_products = $hot_products->select($selected)
            ->selectSub("SELECT SUM(discount)
                        FROM discounts WHERE start_date <= '" . \Illuminate\Support\Carbon::now() . "' and end_date >= '" . \Illuminate\Support\Carbon::now() . "'
                                        AND product_id = products.id AND discounts.type != 3 GROUP BY product_id", 'discount_sale')
            ->groupBy('products.id')
            ->orderBy('amount_product_sold', 'desc')
            ->where('products.vstore_id', $user->id)
            ->where('products.status', 2)
            ->paginate(18);
        $vstore = User::join('products', 'users.id', '=', 'products.user_id')
            ->where('products.vstore_id', $user->id)
            ->groupBy('products.user_id')
            ->where('role_id', 2)
            ->select('users.name', 'users.avatar', 'users.slug')
            ->get();

//        return $product_super;
        return view('screens.landing_page_vstore', compact('logo', 'hot_products', 'name', 'user', 'arrCategory', 'user', 'count_products', 'big_sale', 'vstore', 'fiveImage'));
//        return view('screens.landingpage',compact('logo','banner'));

    }
}
