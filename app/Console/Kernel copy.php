<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('booking:finished')->everyMinute()->appendOutputTo('scheduler.log');
        $schedule->command('booking:ongoing')->everyMinute()->appendOutputTo('scheduler.log');
        $schedule->command('send:reminder')->everyMinute()->appendOutputTo('scheduler.log');
        // $schedule->command('participant:ongoing')->everyMinute()->appendOutputTo('scheduler.log');
    }


    public function scheduleTimezone()
    {
        return 'Asia/Jakarta';
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
