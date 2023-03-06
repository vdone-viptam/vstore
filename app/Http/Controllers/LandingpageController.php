<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            $category = $user->products()->select("category_id")->groupBy('category_id')->get();
//            $category= Category::all();
//            return $category;
            $arrCategory = [];
            foreach ($category as $cate) {
                $arrCategory[] = $cate->category_id;
            }
            $arrCategory = Category::whereIn('id', $arrCategory)->get();
            $count_products = Product::where('status',2)->where('user_id',$user->id)->count();
        } else {
            return redirect(route('landingpagencc'));
        }
        $products = Product::where('status',2)->where('user_id',$user->id)->get();
        foreach ($products as $pro){
            $discount = Discount::where('product_id',$pro->id)
            ->where('start_date','<=',Carbon::now())
                ->where('end_date','>=', Carbon::now())
                ->sum('discount')
            ;
            if ($discount>0){
                $pro->price_discount = $pro->price - ($pro->price /100 * $discount);
            }

        }

        $vstore= User::join('products','users.id','=','products.vstore_id')
        ->where('products.user_id',$user->id)
            ->groupBy('products.vstore_id')
            ->select('users.name','users.avatar')
            ->get();

        $product_super= Product::join('discounts','products.id','=','discounts.product_id')
            ->where('products.user_id',$user->id)
            ->where('discounts.start_date','<=',Carbon::now())
            ->where('discounts.end_date','>=',Carbon::now())
            ->groupBy('products.id')
            ->paginate(4)
        ;
        foreach ($product_super as $ps){
            $sum = Discount::where('product_id',$ps->id)
                ->where('discounts.start_date','<=',Carbon::now())
                ->where('discounts.end_date','>=',Carbon::now())
                ->sum('discount');
            $ps->gia_khuyen_mai = $ps->price - ($ps->price/100 * $sum);
//            return $sum;

        }
        return view('screens.landingpage', compact('logo', 'banner', 'name', 'user', 'arrCategory','user','count_products','products','vstore','product_super'));
//        return view('screens.landingpage',compact('logo','banner'));
    }

    public function ladingpage()
    {
        return view('screens.vstore.index');
    }

    public function ladingpageNCC()
    {
        return view('screens.manufacture.index');
    }

    public function ladingpageStorage()
    {
        return view('screens.storage.index');
    }

    public function vstore($slug){
        $user = User::where('slug', $slug)
            ->where('role_id', 3)
            ->first();
        if ($user) {

            $logo = !empty($user->avatar) ? $user->avatar : '';
            $banner = !empty($user->banner) ? $user->banner : '';
            $name = $user->name ?? '';
//            $category = $user->products()->select("category_id")->groupBy('category_id')->get();
            $category= Product::join('categories','products.category_id','=','categories.id')
                ->where('products.vstore_id',$user->id)
                ->groupBy('products.category_id')
                ->select('categories.id','categories.name','categories.img')
                ->get();
//
//            return $category;
            $arrCategory = [];
            foreach ($category as $cate) {
                $arrCategory[] = $cate->id;
            }
            $arrCategory = Category::whereIn('id', $arrCategory)->get();
            $count_products = Product::where('status',2)->where('user_id',$user->id)->count();
        } else {
            return redirect(route('intro_vstore'));
        }
        $products = Product::where('status',2)->where('vstore_id',$user->id)->get();
        foreach ($products as $pro){
            $discount = Discount::where('product_id',$pro->id)
                ->where('start_date','<=',Carbon::now())
                ->where('end_date','>=', Carbon::now())
                ->sum('discount')
            ;
            if ($discount>0){
                $pro->price_discount = $pro->price - ($pro->price /100 * $discount);
            }

        }

        $ncc= User::join('products','users.id','=','products.vstore_id')
            ->where('products.vstore_id',$user->id)
            ->groupBy('products.user_id')
            ->select('users.name','users.avatar')
            ->get();
//         $vstore;

        $product_super= Product::join('discounts','products.id','=','discounts.product_id')
        ->where('products.vstore_id',$user->id)
            ->where('discounts.start_date','<=',Carbon::now())
            ->where('discounts.end_date','>=',Carbon::now())
            ->groupBy('products.id')
            ->paginate(4)
        ;
        foreach ($product_super as $ps){
            $sum = Discount::where('product_id',$ps->id)
                ->where('discounts.start_date','<=',Carbon::now())
                ->where('discounts.end_date','>=',Carbon::now())
                ->sum('discount');
            $ps->gia_khuyen_mai = $ps->price - ($ps->price/100 * $sum);
//            return $sum;

        }
//        return $product_super;
        return view('screens.landing_page_vstore', compact('logo', 'banner', 'name', 'user', 'arrCategory','user','count_products','products','ncc','product_super'));
//        return view('screens.landingpage',compact('logo','banner'));

    }
}
