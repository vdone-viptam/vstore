<?php

namespace App\Interfaces\API\ReviewProduct;

interface ReviewProductRepositoryInterface
{
    public function calculatorFeeProductPoint($productId,$pointsId);
}
