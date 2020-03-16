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
        Commands\TaskDateCron::class,
        Commands\ActionsDateCron::class,
//        Commands\TestCommand::class,
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
            ->everyFiveMinutes()->sendOutputTo( base_path('storage/logs/punished-sale-man.log'));

        $schedule->command('task-date:cron')
            ->everyFiveMinutes()->sendOutputTo( base_path('storage/logs/tasks.log'));

        $schedule->command('action-date:cron')
            ->everyFiveMinutes()->sendOutputTo( base_path('storage/logs/actions.log'));

        $schedule->command('auto-assign:cron')
            ->dailyAt('7:00')
            ->sendOutputTo( base_path('storage/logs/auto-assign.log'));

//        $schedule->command('test:command')
//            ->everyMinute()
//            ->sendOutputTo(base_path('storage/logs/test-command.log'));
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
