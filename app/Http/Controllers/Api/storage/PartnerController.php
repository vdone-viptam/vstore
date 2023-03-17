<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
        $ncc = User::select('users.name', 'account_code', 'phone_number', 'company_name', 'tax_code')
            ->join('products', 'users.id', '=', 'products.user_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->where('ward_id', $id)
            ->groupBy(['users.name', 'account_code', 'phone_number', 'company_name', 'tax_code'])
            ->paginate(10);

        return response()->json(['success' => true, 'data' => $ncc]);
    }
}
