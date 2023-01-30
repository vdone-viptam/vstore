<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index($slug){
        $user = User::where('slug',$slug)
            ->where('role_id',3)
            ->first();
        if ($user){
            $products = Product::where('vstore_id'.$user->id)->where('status',3);
            if ($products){
//                return view('screens.landingpage');
            }

        }
        $logo = !empty($user->avatar) ? $user->avatar:'';
    $banner = !empty($user->banner)  ? $user->banner:'';
    $name = $user->name;
//    return $logo;
        return view('screens.landingpage',compact('logo','banner','name'));
//        return view('screens.landingpage',compact('logo','banner'));
    }
}
