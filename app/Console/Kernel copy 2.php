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

    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule)
    {

        // this command will run every second
        $shortSchedule->command('booking:finished')->everySecond(30);
        $shortSchedule->command('booking:ongoing')->everySecond(30);
        $shortSchedule->command('send:reminder')->everySecond(30);

        // this command will run every 30 seconds
        // $shortSchedule->command('another-artisan-command')->everySeconds(30);

        // this command will run every half a second
        // $shortSchedule->command('another-artisan-command')->everySeconds(0.5);
    }

    protected function schedule(Schedule $schedule)
    {


        // $seconds = 5;

        // $schedule->call(function () use ($seconds) {

        //     $dt = \Carbon\Carbon::now();

        //     $x = 60 / $seconds;

        //     do {

        //         // do your function here that takes between 3 and 4 seconds

        //         time_sleep_until($dt->addSeconds($seconds)->timestamp);
        //     } while ($x-- > 0);
        // })->everyMinute();



        // $schedule->command('booking:finished')->everyMinute()->appendOutputTo('scheduler.log');
        // $schedule->command('booking:ongoing')->everyMinute()->appendOutputTo('scheduler.log');
        // $schedule->command('send:reminder')->everyMinute()->appendOutputTo('scheduler.log');
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
