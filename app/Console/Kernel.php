<?php

namespace App\Console;

use App\Models\VshopProduct;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */

    protected $commands = [
        Commands\InactiveUser::class,
        Commands\AffProduct::class,
    ];

    protected function schedule(Schedule $schedule)
    {

//        $schedule->command('order:affProduct')->everyMinute();
        $schedule->command('orders:split')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
