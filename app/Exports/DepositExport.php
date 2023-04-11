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
    private $limit;

    private $offset;

    private $start_date;

    private $end_date;

    public function __construct($limit, $offset, $start_date, $end_date)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = Deposit::query()->select('code as Mã giao dịch', 'deposits.name as Chủ tài khoản', 'amount as Số tiền rút', 'account_number as Số tài khoản', 'banks.name as Tên ngân hàng', 'full_name as Tên đầy đủ ngân hàng', 'deposits.created_at as Ngày yêu cầu')
            ->join('banks', 'deposits.bank_id', '=', 'banks.id')
            ->orderBy('deposits.id', 'desc');
        ;
        if ($this->start_date != null) {

            $query = $query->whereDate('deposits.created_at', '>=', $this->start_date);
        }
        if ($this->end_date != null) {
            $query = $query->whereDate('deposits.created_at', '<=', $this->end_date);
        }
        $query = $query->skip($this->offset)
            ->take($this->limit)
            ->get();

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
