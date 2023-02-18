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

            $logo = !empty($user->avatar) ? $user->avatar:'';
            $banner = !empty($user->banner)  ? $user->banner:'';
            $name = $user->name ?? '';
//            if ()
        }else{
           return redirect(route('landingpagencc')) ;
        }


//    return $logo;
        return view('screens.landingpage',compact('logo','banner','name'));
//        return view('screens.landingpage',compact('logo','banner'));
    }
    public function ladingpage(){
        return view('screens.vstore.index');
    }
    public function ladingpageNCC(){
        return view('screens.manufacture.index');
    }
    public function ladingpageStorage(){
        return view('screens.manufacture.index');
    }
}
