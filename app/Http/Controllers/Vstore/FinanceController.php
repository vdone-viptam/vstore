<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(){
        return view('screens.vstore.finance.index');
    }
    public function revenue(){
        return view('screens.vstore.finance.revenue');
    }
}
