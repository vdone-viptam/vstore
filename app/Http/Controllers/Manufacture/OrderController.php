<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('screens.manufacture.order.index', []);
    }

    public function destroy()
    {
        return view('screens.manufacture.order.destroy', []);

    }

    public function pending()
    {
        return view('screens.manufacture.order.pending', []);

    }
}
