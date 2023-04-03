<?php

namespace App\Repositories\BigStore;

use App\Interfaces\BigStore\CallApiRepositoryInterface;
use Illuminate\Support\Facades\Http;

class CallApiRepository implements CallApiRepositoryInterface
{
    public function callApiCustomerProfile($customerId)
    {
        $response = Http::get( env('DOMAIN_BIGSTORE'). '/api/users/conversation-participant/'.$customerId);
        $customer = $response->object();
        if(!empty($customer)){
            if(!empty($customer->data)){
                $profileCustomer = [];
                $profileCustomer['name_customer'] = $customer->data->displayName;
                $profileCustomer['image_customer'] = $customer->data->avatar;
                $profileCustomer['customer_id'] = $customer->data->id;
                return $profileCustomer;
            }else{
                return null;
            }
        }
    }
}

