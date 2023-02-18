<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        return view('screens.storage.product.index', []);
    }

    public function request()
    {
        return view('screens.storage.product.request', []);

    }
}
