<?php

namespace App\Repositories\Storage\Partner;

use App\Interfaces\Storage\Partner\PartnerRepositoryInterface;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PartnerRepository implements PartnerRepositoryInterface
{
    public function index($search, $limit){

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
    public function deliveryPartner($search, $limit)
    {
        $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;

        $ncc = OrderItem::query()
            ->select(
                'delivery_partner.name_partner', 'delivery_partner.code_partner', 'delivery_partner.id as delivery_partner_id',
                DB::raw('count(*) as count_product'),
            )
            ->selectSub('select COUNT(order.id)
                from `order`
                join order_item on order.id = order_item.order_id
                where export_status = 5 and order_item.warehouse_id =' . $id . ' and delivery_partner_id= delivery_partner.id',
                'destroy_order')
            ->join('products', 'order_item.product_id', 'products.id')
            ->join('order', 'order.id', 'order_item.order_id')
            ->join('delivery_partner', 'delivery_partner.id', 'order_item.delivery_partner_id')
            ->where('order_item.warehouse_id', $id)
            ->where('order.export_status', 4);

        if (isset($search)) {
            $ncc = $ncc->where(function ($query) use ($search) {
                $query->where('delivery_partner.name_partner', 'like', '%' . $search . '%')
                    ->orWhere('delivery_partner.code_partner', 'like', '%' . $search . '%');
            });
        }

        $ncc = $ncc->groupBy(['delivery_partner_id']);
        if (isset($limit)) {
            $ncc = $ncc->paginate($limit);
        }
        return $ncc;
    }
    public function detailDeliveryPartner($delivery_partner_id)
    {
        $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
        $data = OrderItem::query()
            ->select(DB::raw('count(*) as count_product'),
                'delivery_partner.name_partner', 'delivery_partner.code_partner', 'delivery_partner.id as delivery_partner_id',
            )
            ->selectSub('select COUNT(order.id)
                from `order`
                join order_item on order.id = order_item.order_id
                where export_status = 5 and order_item.warehouse_id =' . $id . ' and delivery_partner_id= delivery_partner.id',
                'destroy_order')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->join('delivery_partner', 'delivery_partner.id', 'order_item.delivery_partner_id')
            ->join('order', 'order.id', '=', 'order_item.order_id')
            ->join('warehouses', 'warehouses.id', '=', 'order.warehouse_id')
            ->where('order.export_status', 4)
            ->where('order_item.warehouse_id', $id)
            ->where(function ($query) use ($delivery_partner_id) {
                $query->where('order_item.delivery_partner_id', $delivery_partner_id )
                    ->orWhere('delivery_partner.code_partner', $delivery_partner_id);
            })->get();

        // $result = $data->where('order_item.delivery_partner_id', $delivery_partner_id)->get();
        // if (count($result) == 0) {
        //     $data = $data->where('delivery_partner.code_partner', $delivery_partner_id)->get();
        // } else {
        //     $data = $result;
        // }

        return $data;

    }
}


