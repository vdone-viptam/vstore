<?php

namespace App\Interfaces\Storage\Partner;

interface PartnerRepositoryInterface
{
    public function index($search, $limit, $type, $field);

    public function detailNcc($user_id);

    public function deliveryPartner($search, $limit, $type, $field);

    public function detailDeliveryPartner($delivery_partner_id);
}
