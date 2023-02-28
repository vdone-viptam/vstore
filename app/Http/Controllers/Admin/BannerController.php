<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $this->v['banners'] = [];


        return view('screens.admin.banner.index', $this->v);
    }
}
