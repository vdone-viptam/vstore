<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        return view('screens.vstore.partner.index', $this->v);

    }

    public function vshop()
    {
        return view('screens.vstore.partner.vshop', $this->v);

    }

    public function ship()
    {
        return view('screens.vstore.partner.ship', $this->v);

    }
}
