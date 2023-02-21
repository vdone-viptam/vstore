<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        return view('screens.storage.finance.index', []);
    }

    public function history()
    {
        return view('screens.storage.finance.history', []);
    }
}
