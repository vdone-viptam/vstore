<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $users = User::join('products','users.id','=','products.user_id')
                        ->join('product_warehouses','products.id','=','product_warehouses.product_id')
                        ->join('warehouses','product_warehouses.ware_id','=','warehouses.id')
                        ->groupBy('users.id')
            ->get();
        return $users;
        return view('screens.storage.partner.index' );

    }
}
