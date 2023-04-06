<?php

namespace App\Repositories\Storage\Partner;

use App\Interfaces\Storage\Partner\PartnerRepositoryInterface;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PartnerRepository implements PartnerRepositoryInterface
{
    public function index($search, $limit){
        // dd( isset($search), $limit);
        $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
        $ncc = User::query()
            ->select('users.name', 'account_code', 'province.province_name', 'users.id as user_id',
                DB::raw('count(*) as count_product'),
                DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
            )
            ->join('province', 'users.provinceId', '=', 'province.province_id')
            ->join('products', 'users.id', '=', 'products.user_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->where('ware_id', $id);
        if (isset($search)) {
            $ncc = $ncc->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.account_code', 'like', '%' . $search . '%');
            });
        }
        $ncc = $ncc->groupBy(['users.name', 'account_code']);
        if (isset($limit)) {
            $ncc = $ncc->paginate($limit);
        }
        // dd($ncc->get());
        return $ncc;
    }
    public function detailNcc($user_id){
        $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
        $ncc = User::query()
            ->select('users.name', 'account_code', 'province.province_name', 'users.id as user_id',
                DB::raw('count(*) as count_product'),
                DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
            )
            ->join('province', 'users.provinceId', '=', 'province.province_id')
            ->join('products', 'users.id', '=', 'products.user_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->where('ware_id', $id);

        $result = $ncc->where('products.user_id', $user_id)->first();

        if (!$result) {
            $ncc = $ncc->where('users.account_code', $user_id)->first();
        } else {
            $ncc = $result;
        }
        return $ncc;
    }
}


