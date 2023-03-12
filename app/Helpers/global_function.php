<?php


use App\Models\Discount;
use Illuminate\Support\Carbon;

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
        $price = $discount->price;
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

function getDiscountProduct($id, $idVshop) {
    $discounts = Discount::where('product_id', $id)
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
        $price = $discount->price;
        $discountProduct = $discount->discount;
        switch ($type) {
            case config('constants.typeDiscount.ncc') : {
                $discountsFromSuppliers = $price - ($price * ($discountProduct/100));
                $return['discountsFromSuppliers'] = $discountsFromSuppliers;
                break;
            }
            case config('constants.typeDiscount.vstore') : {
                $discountsFromVStore = $price - ($price * ($discountProduct/100));
                $return['discountsFromVStore'] = $discountsFromVStore;
                break;
            }
            case config('constants.typeDiscount.vshop') : {
                $discountsFromVShop = $price - ($price * ($discountProduct/100));
                $return['discountsFromVShop'] = $discountsFromVShop;
                break;
            }
            default: {
                break;
            }
        }
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

//2 - Giao dịch đang xử lý
//3 - Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)
//5 - Giao dịch thành công
//6 - Giao dịch thất bại
//8 - Giao dịch bị hủy
//9 - Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)
//16 - Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toán Chuyển khoản ngân hàng)
