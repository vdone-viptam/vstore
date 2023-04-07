<?php

namespace App\Interfaces\Storage\Partner;

interface PartnerRepositoryInterface
{
    public function index($search , $limit);
    public function detailNcc($user_id);
    public function deliveryPartner($limit);
    public function detailDeliveryPartner($delivery_partner_id);
}
