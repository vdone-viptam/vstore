<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(){
        return view('screens.manufacture.discount.index');
    }
    public function add(){
     return view('screens.manufacture.discount.createDis');
    }
    public function saveAdd(Request $request){
        return $request;
    }
}
