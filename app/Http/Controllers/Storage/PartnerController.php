<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Interfaces\Storage\Partner\PartnerRepositoryInterface;
use Illuminate\Http\Request;


class PartnerController extends Controller
{
    private PartnerRepositoryInterface $partnerRepository;

    public function __construct(PartnerRepositoryInterface $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function index(Request $request)
    {
        $search = $request->key_search;
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'asc';
        $field = $request->field ?? 'users.id';
        $suppliers = $this->partnerRepository->index($search, $limit, $type, $field);
        return view('screens.storage.partner.supplier.index', ['suppliers' => $suppliers, 'key_search' => trim($search), 'type' => $type, 'field' => $field]);
    }

    public function detailNcc(Request $request)
    {
        $ncc = $this->partnerRepository->detailNcc($request->user_id);
        return response()->json(['success' => true, 'data' => $ncc]);
    }

    public function deliveryPartner(Request $request)
    {
        $search = $request->key_search;
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'asc';
        $field = $request->field ?? 'delivery_partner.id';
        $deliveryPartners = $this->partnerRepository->deliveryPartner($search, $limit, $type, $field);
        return view('screens.storage.partner.delivery-partner.index', ['deliveryPartners' => $deliveryPartners, 'key_search' => trim($search), 'type' => $type, 'field' => $field]);
    }

    public function detailDeliveryPartner(Request $request)
    {
        $deliveryPartners = $this->partnerRepository->detailDeliveryPartner($request->delivery_partner_id);
        return response()->json(['success' => true, 'data' => $deliveryPartners]);
    }
}
