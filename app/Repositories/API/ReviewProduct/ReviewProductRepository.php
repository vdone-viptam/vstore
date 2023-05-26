<?php

namespace App\Repositories\API\ReviewProduct;

use App\Interfaces\API\ReviewProduct\ReviewProductRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class ReviewProductRepository implements ReviewProductRepositoryInterface
{
    public function calculatorFeeProductPoint($productId,$pointsId)
    {
        $product = Product::where('id',$productId)->first();

        $array = [];
        if($product){
            $array['name_product'] = $product->name;
            $array['name'] = $product->name;
            $array['product_id'] = $product->id;
            $array['id'] = $product->id;
            $array['images_product'] = null;
            $array['images'] = null;
            $array['image'] = null;
            if(!empty($product->images)){
                $array_images = json_decode($product->images);
                $array['images_product'] = asset($array_images[0]);
                $array['image'] = asset($array_images[0]);
                foreach ($array_images as $key => $value) {
                    $array['images'][] = asset($value);
                }
            }
            $orderItem = OrderItem::join('points','points.order_item_id','order_item.id')
                ->join('order','order.id','order_item.order_id')
                ->where('points.id',$pointsId)
                ->select(
                    'order_item.quantity',
                    'discount_vshop',
                    'discount_ncc',
                    'discount_vstore',
                    'order_item.price',
                    'order.shipping',
                )
                ->first();

                $orderItem->quantity =$orderItem->quantity??0;
                $array['count_product'] = $orderItem->quantity;
                $array['quantity'] = $orderItem->quantity;

                // a = ( giá sp * sl) - giảm giá
                //  b = a *vat (tính vat)
                // số tiền thực tế phải đóng = a + b + phí ship
                $totalDiscount = ($orderItem->discount_vshop + $orderItem->discount_ncc + $orderItem->discount_vstore );
                if( $totalDiscount  > 0 ){
                    $totalDiscount = $totalDiscount /100;
                }
                $totalProduct = $orderItem->price * $orderItem->quantity;
                $shipping = $orderItem->shipping;
                $totalVat = $product->vat;
                if( $totalVat  > 0 ){
                    $totalVat = $totalVat / 100 ;
                }
                $amount_to_pay = $totalProduct  -  (  $totalProduct * $totalDiscount );
                // $amount_to_pay = $amount_to_pay + $amount_to_pay* $totalVat + $shipping;
                $array['amount_to_pay'] = $amount_to_pay;
                $array['price_product'] = $totalProduct;
                $array['price'] = $totalProduct;
            }
            return $array;

    }
    public function calculatorFeeProductOrder($productId,$orderItemId)
    {
        $array = [];
        $orderItem = OrderItem::join('points','points.order_item_id','order_item.id')
            ->join('order','order.id','order_item.order_id')
            ->where('order_item.id',$orderItemId)
            ->where('order_item.product_id',$productId)
            ->select(
                'order_item.quantity',
                'discount_vshop',
                'discount_ncc',
                'discount_vstore',
                'order_item.price',
                'order.shipping',
            )
            ->first();
        if($orderItem){
            $product = Product::where('id',$productId)->first();
            $array['name'] = $product->name;
            $array['images'] = null;
            $array['image'] = null;
            if(!empty($product->images)){
                $array_images = json_decode($product->images);
                $array['image'] = asset($array_images[0]);
                foreach ($array_images as $key => $value) {
                    $array['images'][] = asset($value);
                }
            }
            $array['quantity'] = $orderItem->quantity;

            // a = ( giá sp * sl) - giảm giá
            //  b = a *vat (tính vat)
            // số tiền thực tế phải đóng = a + b + phí ship
            $totalDiscount = ($orderItem->discount_vshop + $orderItem->discount_ncc + $orderItem->discount_vstore );
            if( $totalDiscount  > 0 ){
                $totalDiscount = $totalDiscount /100;
            }
            $totalProduct = $orderItem->price * $orderItem->quantity;
            $shipping = $orderItem->shipping;
            $totalVat = $product->vat;
            if( $totalVat  > 0 ){
                $totalVat = $totalVat / 100 ;
            }
            $amount_to_pay = $totalProduct  -  (  $totalProduct * $totalDiscount );
            // $amount_to_pay = $amount_to_pay + $amount_to_pay* $totalVat + $shipping;
            $array['amount_to_pay'] = $amount_to_pay;
            $array['price'] = $totalProduct;
        }
        return $array;
    }
}
