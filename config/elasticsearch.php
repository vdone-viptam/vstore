<?php


return [
    'node' => env('ELASTICSEARCH_NODE', 'localhost:9200'),
    'username' => env('ELASTICSEARCH_USERNAME', ''),
    'password' => env('ELASTICSEARCH_PASSWORD', ''),
    'max_retries' => env('ELASTICSEARCH_MAX_RETRIES', ''),
    'req_timeout' => env('ELASTICSEARCH_REQ_TIMEOUT', ''),
    'vstore_products' => 'vstore_products',
    'vstore_categories' => 'vstore_categories',
    'vstore' => 'vstore',
    'vshop' => 'vshop',
    'supplier' => 'supplier',
];
