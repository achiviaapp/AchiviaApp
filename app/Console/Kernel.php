<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PunishedSaleManCron::class,
        Commands\AutoAssignClientCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('punished-sale-man:cron')
            ->everyFiveMinutes()->sendOutputTo( url('storage/logs/punished-sale-man.log'));

        $schedule->command('auto-assign:cron')
            ->dailyAt('7:00')
            ->sendOutputTo( url('storage/logs/auto-assign.log'));

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
