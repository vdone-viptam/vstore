<?php


use App\Models\Discount;
use Illuminate\Support\Carbon;

//function calculateShippingByProductID($results, $districtId, $provinceId) {
//    $grouped = [];
//    foreach ($results as $item) {
//        $vshop_id = $item['vshop_id'];
//        $product_id = $item['product_id'];
//        if (!isset($grouped[$vshop_id])) {
//            $grouped[$vshop_id] = ['vshop_id' => $vshop_id, 'product_id' => []];
//        }
//        $grouped[$vshop_id]['product_id'][] = $product_id;
//    }
//
//    foreach ($grouped as $key => $value) {
//        $vshop_id = $value['vshop_id'];
//        $product_id = $value['product_id'];
//
//        $checkShipVShop = \App\Models\VshopProduct::whereIn('product_id', $product_id)
//            ->where('status', config('constants.statusVShopProduct.ready_goods')) // ready_goods nhập hàng sẵn
//            ->where('vshop_id', $vshop_id)->get();
//    }
//
//}

function getDiscountProducts($id, $idVshop) {
    $discounts = Discount::whereIn('product_id', $id)
        ->where('discounts.user_id', $idVshop)
        ->where('discounts.start_date', '<=', Carbon::now())
        ->where('discounts.end_date', '>=', Carbon::now())
        ->join('products', 'products.id', '=', 'discounts.product_id')
        ->select('discounts.type', 'discounts.discount', 'products.id', 'products.price')
        ->get();
    $return = [];
    foreach ($discounts as $index => $discount) {
        $type = $discount->type;
        $productId = $discount->id;
        $discountProduct = $discount->discount;
        switch ($type) {
            case config('constants.typeDiscount.ncc') : {
                $discountsFromSuppliers = $discountProduct;
                $return[$index]['discountsFromSuppliers'] = $discountsFromSuppliers;
                break;
            }
            case config('constants.typeDiscount.vstore') : {
                $discountsFromVStore = $discountProduct;
                $return[$index]['discountsFromVStore'] = $discountsFromVStore;
                break;
            }
            case config('constants.typeDiscount.vshop') : {
                $discountsFromVShop = $discountProduct;
                $return[$index]['discountsFromVShop'] = $discountsFromVShop;
                break;
            }
            default: {
                break;
            }
        }
        $return[$index]['id'] = $productId;
    }
    $result = array_reduce($return, function($arr, $item) {
        $arr[$item['id']] = isset($arr[$item['id']]) ? ($arr[$item['id']] + $item) : $item;
        return $arr;
    }, []);
    return $result;
}

function getWarehouse($province_id, $district_id, $product_id) {

    $address = \Illuminate\Support\Facades\DB::table('province')
        ->join('district', 'district.province_id', '=', 'province.province_id')
        ->where('province.province_id', $province_id)
        ->first();

    if(!$address) {
        return false;
    }

    $warehouse = \App\Models\Warehouses::where('product_warehouses.product_id', $product_id)
        ->join('product_warehouses', 'product_warehouses.ward_id', '=', 'warehouses.id')
//        ->where('warehouses.district_id', $district_id)
//        ->where('warehouses.city_id', $province_id)
        ->get();
    dd($warehouse);


    dd($address->province_name . ', ' . $address->district_name);
}

function getDiscountAndDepositMoney($quantity, $arr) {
    foreach($arr as $item) {
        if($quantity >= $item['start'] && $quantity < $item['end']) {
            return [
                "discount" => $item['discount'],
                "deposit_money" => $item['deposit_money']
            ];
        } elseif($item['end'] == 0) {
            return [
                "discount" => $item['discount'],
                "deposit_money" => $item['deposit_money']
            ];
        }
    }
}

function getDiscountProduct($id, $idVshop) {
    $discounts = Discount::where('product_id', $id)
        ->where('discounts.type', config('constants.discountType.ncc'))
        ->orWhere('discounts.type', config('constants.discountType.vstore'))
        ->where('discounts.start_date', '<=', Carbon::now())
        ->where('discounts.end_date', '>=', Carbon::now())
        ->join('products', 'products.id', '=', 'discounts.product_id')
        ->select('discounts.type', 'discounts.discount', 'products.id', 'products.price')
        ->get();

    $discountVShop = Discount::where('product_id', $id)
        ->where('discounts.user_id', $idVshop)
        ->where('discounts.type', config('constants.discountType.vshop'))
        ->where('discounts.start_date', '<=', Carbon::now())
        ->where('discounts.end_date', '>=', Carbon::now())
        ->join('products', 'products.id', '=', 'discounts.product_id')
        ->select('discounts.type', 'discounts.discount', 'products.id', 'products.price')
        ->first();

    $return = [];
    foreach ($discounts as $index => $discount) {
        $type = $discount->type;
        $discountProduct = $discount->discount;
        switch ($type) {
            case config('constants.typeDiscount.ncc') : {
                $return['discountsFromSuppliers'] = $discountProduct;
                break;
            }
            case config('constants.typeDiscount.vstore') : {
                $return['discountsFromVStore'] = $discountProduct;
                break;
            }
            case config('constants.typeDiscount.vshop') : {
                $return['discountsFromVShop'] = $discountProduct;
                break;
            }
            default: {
                break;
            }
        }
    }

    if($discountVShop) {
        $return['discountsFromVShop'] = $discountVShop->discount;
    }
    return $return;
}

function status9Pay($status)
{
    switch ($status) {
        case 2: {
            return [
                'message' => 'Giao dịch đang xử lý'
            ];
        }
        case 3: {
            return [
                'message' => 'Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)'
            ];
        }
        case 5: {
            return [
                'message' => 'Giao dịch thành công'
            ];
        }
        case 6: {
            return [
                'message' => 'Giao dịch thất bại'
            ];
        }
        case 8: {
            return [
                'message' => 'Giao dịch bị hủy'
            ];
        }
        case 9: {
            return [
                'message' => 'Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)'
            ];
        }
        case 16: {
            return [
                'message' => 'Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toán Chuyển khoản ngân hàng)'
            ];
        }
        default: {
            return [
                'message' => 'Giao dịch đang xử lý'
            ];
        }

    }
}
function statusPreOrder($status)
{
    switch ($status) {
        case config('constants.statusPreOrder.done'): {
            return "Hoàn thành";
        }
        case config('constants.statusPreOrder.user_confirm'): {
            return "Chờ xác nhận";
        }
        case config('constants.statusPreOrder.shipping'): {
            return "Đang giao hàng";
        }
        case config('constants.statusPreOrder.cancel'): {
            return "Đơn huỷ";
        }
        default: {
            return "Đơn hàng chưa được xử lý";
        }
    }
}

//2 - Giao dịch đang xử lý
//3 - Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)
//5 - Giao dịch thành công
//6 - Giao dịch thất bại
//8 - Giao dịch bị hủy
//9 - Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)
//16 - Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toán Chuyển khoản ngân hàng)
