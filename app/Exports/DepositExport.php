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
    private $limit = null;

    private $offset = null;

    public function __construct($limit, $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function collection()
    {
        $query = Deposit::query()->select('code as Mã giao dịch', 'deposits.name as Chủ tài khoản', 'amount as Số tiền rút', 'account_number as Số tài khoản', 'banks.name as Tên ngân hàng', 'full_name as Tên đầy đủ ngân hàng', 'deposits.created_at as Ngày yêu cầu')
            ->join('banks', 'deposits.bank_id', '=', 'banks.id')
            ->skip($this->offset)
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
