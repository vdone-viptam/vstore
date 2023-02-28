<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

/**
 * @group Cart
 *
 * Danh sách api liên quan tới giỏ hàng
 */
class BannerController extends Controller
{
    //
    /**
     * Lấy banner ở trang chủ
     *
     * API dùng để lấy ảnh banner
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBannerHomePage()
    {
        try {
            $banner = Banner::where('id', 1)->first()->img;
            return response()->json([
                'status_code' => 200,
                'data' => asset($banner)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
