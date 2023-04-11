<?php

namespace App\Interfaces\API\ReviewProduct;

interface ReviewProductRepositoryInterface
{
    // vì lúc tạo hàm này sử dụng point id nên ko thể tái sd @@
    public function calculatorFeeProductPoint($productId,$pointsId);

    // tạo hàm này để check giá trc khi đánh giá, nếu có thể thì gộp 2 hàm thành 1 ( calculatorFeeProductPoint, calculatorFeeProductOrder )
    public function calculatorFeeProductOrder($productId,$orderItemId);
}
