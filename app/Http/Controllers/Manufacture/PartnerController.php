<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //

    public function index()
    {
        return view('screens.manufacture.partner.index', []);
    }

    public function report()
    {
        return view('screens.manufacture.partner.report', []);

    }
}
