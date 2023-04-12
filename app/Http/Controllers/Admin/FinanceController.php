<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DepositExport;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FinanceController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $this->v['histories'] = Deposit::select('name', 'amount', 'id', 'status', 'account_number', 'code', 'old_money', 'bank_id', 'created_at')
            ->orderBy('id', 'desc');
//            ->paginate(10);
        if ($request->start_date) {
            $this->v['histories'] = $this->v['histories']->whereDate('created_at', '>=', $request->start_date);
            $this->v['start_date'] = $request->start_date;
        }
        if ($request->end_date) {
            $this->v['histories'] = $this->v['histories']->whereDate('created_at', '<=', $request->end_date);
            $this->v['end_date'] = $request->end_date;
        }
        $this->v['histories'] = $this->v['histories']->paginate($limit);
        $this->v['limit'] = $limit;
        return view('screens.admin.finance.index', $this->v);
    }

    public function exportDeposits(Request $request)
    {

        try {
            return Excel::download(new DepositExport($request->start_date, $request->end_date), Carbon::now()->format('d-m-Y') . ' -yeu_cau_rut_tien' . '.xlsx');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }
}
