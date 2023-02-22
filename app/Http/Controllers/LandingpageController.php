<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index($slug)
    {
        $user = User::where('slug', $slug)
            ->where('role_id', 2)
            ->first();
        if ($user) {

            $logo = !empty($user->avatar) ? $user->avatar : '';
            $banner = !empty($user->banner) ? $user->banner : '';
            $name = $user->name ?? '';
            $category = $user->products()->select("category_id")->groupBy('category_id')->get();
            $arrCategory = [];
            foreach ($category as $cate) {
                $arrCategory[] = $cate->category_id;
            }
            $arrCategory = Category::whereIn('id', $arrCategory)->get();
//            if ()
        } else {
            return redirect(route('landingpagencc'));
        }


//    return $logo;
        return view('screens.landingpage', compact('logo', 'banner', 'name', 'user', 'arrCategory'));
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
}
