<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Lấy dữ liệu thành công'
        ]);
    }
}
