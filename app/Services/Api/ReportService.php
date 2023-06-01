<?php

namespace App\Services\Api;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\Service;
use Carbon\Carbon;

class ReportService extends Service
{
    public function report($startDate, $endDate)
    {
        $totalUserLogin = $this->reportTotalUserLogin();
        $totalShop = $this->reportTotalShop();
        $totalNewShop = $this->reportTotalNewShop($startDate, $endDate);
        $totalOrderSuccess = $this->reportTotalOrderSuccess($startDate, $endDate);
        $totalOrderFail = $this->reportTotalOrderFail($startDate, $endDate);
        $totalAmountOrderSuccess = $this->reportTotalMountOrderSuccess($startDate, $endDate);
        $totalProduct = $this->reportTotalProduct();
        $totalNewProduct = $this->reportTotalNewProduct($startDate, $endDate);

        return [
            'total_user' => $totalUserLogin,
            'total_shop' => $totalShop,
            'total_new_shop' => $totalNewShop,
            'total_product' => $totalProduct,
            'total_new_product' => $totalNewProduct,
            'total_order_success' => $totalOrderSuccess,
            'total_order_fail' => $totalOrderFail,
            'total_amount_order_success' => $totalAmountOrderSuccess,
        ];
    }

    protected function reportTotalOrderSuccess($startDate, $endDate)
    {
        $queryOrderSuccess = Order::where('is_split', 1);
        // tìm kiếm
        if (!$startDate && !$endDate) {
            $queryOrderSuccess->get();
        } elseif ($startDate && $endDate) {
            $queryOrderSuccess->whereBetween('updated_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()]);
        } elseif ($startDate) {
            $queryOrderSuccess->where('updated_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $queryOrderSuccess->where('updated_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        // Lấy tổng số lượng order thành công
        return $queryOrderSuccess->count();
    }

    protected function reportTotalOrderFail($startDate, $endDate)
    {
        $queryOrderFail = Order::where('is_split', 2);
        // tìm kiếm
        if (!$startDate && !$endDate) {
            $queryOrderFail->get();
        } elseif ($startDate && $endDate) {
            $queryOrderFail->whereBetween('updated_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()]);
        } elseif ($startDate) {
            $queryOrderFail->where('updated_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $queryOrderFail->where('updated_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        // Lấy tổng số lượng order thất bại
        return $queryOrderFail->count();

    }

    protected function reportTotalMountOrderSuccess($startDate, $endDate)
    {
        $queryMountOrderSuccess = Order::where('is_split', 1);
        // tìm kiếm
        if ($startDate && $endDate) {
            $queryMountOrderSuccess->whereBetween('updated_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()]);
        } elseif ($startDate) {
            $queryMountOrderSuccess->where('updated_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $queryMountOrderSuccess->where('updated_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        // Lấy tổng số tiền order thành công
        return $queryMountOrderSuccess->sum('total');
    }

    protected function reportTotalProduct()
    {
        return Product::where('admin_confirm_date', '!=', null)->count();

    }

    protected function reportTotalNewProduct($startDate, $endDate)
    {
        $queryNewProduct = Product::where('admin_confirm_date', '!=', null);
        // tìm kiếm
        if (!$startDate && !$endDate) {
            $queryNewProduct->get();
        }
        elseif ($startDate && $endDate) {
            $queryNewProduct->whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()]);
        } elseif ($startDate) {
            $queryNewProduct->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $queryNewProduct->where('created_at', '<=', Carbon::parse($startDate)->endOfDay());
        }

        // Lấy tổng số sản phẩm mới
        return $queryNewProduct->count();

    }

    protected function reportTotalShop()
    {
        return User::where('role_id', User::ROLE_SHOP)
            ->where('confirm_date', '!=', null)
            ->count();

    }

    protected function reportTotalNewShop($startDate, $endDate)
    {
        $queryNewShop = User::where('role_id', User::ROLE_SHOP)
            ->where('confirm_date', '!=', null);
        // tìm kiếm
        if (!$startDate && !$endDate) {
            $queryNewShop->get();
        }
        elseif ($startDate && $endDate) {
            $queryNewShop->whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()]);
        } elseif ($startDate) {
            $queryNewShop->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $queryNewShop->where('created_at', '<=', Carbon::parse($startDate)->endOfDay());
        }

        // Lấy tổng số shop mới
        return $queryNewShop->count();

    }

    protected function reportTotalUserLogin()
    {
        return User::where('confirm_date', '!=', null)->count();
    }
}
