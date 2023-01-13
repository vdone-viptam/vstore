<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('screens.vstore.order.index');
    }
    public function new(){
        return view('screens.vstore.order.new');
    }
}
