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

    public function index()
    {
        $this->v['histories'] = Deposit::select('name', 'amount', 'id', 'status', 'account_number', 'code', 'old_money', 'bank_id', 'created_at')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('screens.admin.finance.index', $this->v);
    }

    public function exportDeposits(Request $request)
    {

        try {
            return Excel::download(new DepositExport($request->start_date, $request->end_date), Carbon::now()->format('d-m-Y') . ' -yeu_cau_rut_tien' . '.xlsx');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('success', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }
}
