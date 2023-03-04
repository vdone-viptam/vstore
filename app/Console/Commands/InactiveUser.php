<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InactiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:inactiveUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Khóa các tài khoản đã hết thời gian sử dụng';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('users')
            ->where('expiration_date', Carbon::now()->format('Y-m-d'))
            ->where('account_code', '!=', null)
            ->update(['status' => 4]);
    }
}
