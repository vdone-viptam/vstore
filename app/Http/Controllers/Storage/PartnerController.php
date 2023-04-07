<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Interfaces\Storage\Partner\PartnerRepositoryInterface;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    private PartnerRepositoryInterface $partnerRepository;
    public function __construct(PartnerRepositoryInterface $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $ncc = $this->partnerRepository->index($search,$limit)->get();
        if ( request()->ajax()) {
            return Datatables::of($ncc)->make(true);
        }
        return view('screens.storage.partner.supplier.index', ['ncc' => $ncc]);
    }
    public function detailNcc(Request $request)
    {
        $ncc = $this->partnerRepository->detailNcc($request->user_id);
        return response()->json(['success' => true, 'data' => $ncc]);
    }
    public function deliveryPartner(Request $request)
    {
        $limit = $request->limit;
        $ncc = $this->partnerRepository->deliveryPartner($limit)->get();
        if ( request()->ajax()) {
            return Datatables::of($ncc)->make(true);
        }
        return view('screens.storage.partner.delivery-partner.index');
    }
}
