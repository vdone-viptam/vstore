<?php

namespace App\Exports;

use App\Models\Deposit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepositExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $start_date = null;

    private $end_date = null;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = Deposit::select('code as Mã giao dịch', 'deposits.name as Chủ tài khoản', 'amount as Số tiền rút', 'account_number as Số tài khoản', 'banks.name as Tên ngân hàng', 'full_name as Tên đầy đủ ngân hàng', 'deposits.created_at as Ngày yêu cầu')
            ->join('banks', 'deposits.bank_id', '=', 'banks.id')
            ->where('status', 0);

        if ($this->start_date != null) {

            $query = $query->where('deposits.created_at', '>=', $this->start_date);
        }
        if ($this->end_date != null) {
            $query = $query->where('deposits.created_at', '<=', $this->end_date);
        }

        $query = $query->get();
        $query1 = Deposit::where('status', 0);
        if ($this->start_date != null) {
            $query1 = $query1->where('created_at', '>=', $this->start_date);
        }
        if ($this->end_date != null) {
            $query1 = $query1->where('created_at', '<=', $this->end_date);
        }

        $query1->update(['status' => 1]);
        return $query;

    }

    public function headings(): array
    {
        return [
            'Mã giao dịch',
            'Chủ tài khoản',
            'Số tiền rút',
            'Số tài khoản',
            'Tên ngân hàng',
            'Tên đầy đủ ngân hàng',
            'Ngày yêu cầu'
        ];
    }
}
