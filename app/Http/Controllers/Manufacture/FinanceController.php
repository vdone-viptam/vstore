<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    //

    public function index()
    {
        return view('screens.manufacture.finance.index', []);

    }
}
