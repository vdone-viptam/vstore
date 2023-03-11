<?php


return [
    'billPaymentStatus' => [
        'pay'=>1,
        'unpaid'=>2
    ],
    'orderStatus' => [
        'wait_for_confirmation' => 2,
        'confirmation' => 1
    ],
    'methodPayment' => [
        'atm_card' => 'ATM_CARD',
        'credit_card' => 'CREDIT_CARD',
        '9pay' => '9PAY',
        'back_transfer' => 'BANK_TRANSFER',
        'cod' => 'COD',
    ],
    'userConfirm'=>[
        'confirm' => 1,
        'unconfimred' => 2
    ],
    'statusCart'=>[
        'cart' => 2,
        'checkout' => 1
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
    ]
];
