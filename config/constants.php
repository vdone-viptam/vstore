<?php


return [
    'billPaymentStatus' => [
        'pay'=>1,
        'unpaid'=>2
    ],
    //ORDER SERVICE
    'orderServiceStatus' => [
        'wait_for_confirmation' => 2, // đợi ng dùng thanh toán
        'confirmation' => 1, // người dùng
        'done' => 3, // Đăng ký thành công
    ],
    // ORDER
    'orderStatus' => [
        'wait_for_confirmation' => 2, // đợi ng dùng thanh toán
        'confirmation' => 1, // người dùng
        'success' => 3, // hàng đến tay người dùng
    ],
    'payStatus' => [ // được phép thanh toán hay chưa
        'pay' => 1,
        'unpaid' => 2
    ],
    'paymentStatus' => [ // trạng thái thanh toán
        'done' => 1,
        'no_done' => 2
    ],
    'methodPayment' => [
        'atm_card' => 'ATM_CARD',
        'credit_card' => 'CREDIT_CARD',
        '9pay' => '9PAY',
        'back_transfer' => 'BANK_TRANSFER',
        'cod' => 'COD',
    ],
    // END ORDER
    // CART
    'cartStatus' => [
        'done' => 1,
        'no_done' => 2
    ],
    'statusCart'=>[ // Khả năng sẽ xoá
        'cart' => 2,
        'checkout' => 1
    ],
    // END CART
    // PRODUCT
    'typePay' => [
        'prepay' => 1,
        'postpaid' => 2
    ],
    'productStatus' => [
        'activity' => 2,
        'inactive' => 1
    ],
    // END PRODUCT

    // PRE_ORDER
    'statusPreOrder' => [
        'done' => 1,
        'user_confirm' => 2,
        'new_oder' => 3, // người dụng tạo chưa confirm
        'shipping' => 4,
        'cancel' => 5
    ],
    // END PRE_ORDER


    //PRODUCT_VSHOP
    'statusVShopProduct' => [
        'marketing' => 1,
        'ready_goods' => 2,
    ],
    'userConfirm'=>[
        'confirm' => 1,
        'unconfimred' => 2
    ],
    'discountType'=>[
        'ncc' => 1,
        'vstore' => 2,
        'vshop' => 3
    ],
    'typeDiscount' => [
        'ncc' => 1,
        'vstore' => 2,
        'vshop' => 3
    ],
    // Mua dịch vụ
    'orderService' => [
        'price_ncc' => 12000000,
        'price_kho' => 1200000,
        'price_vstore' => 300000000,
    ]
];
