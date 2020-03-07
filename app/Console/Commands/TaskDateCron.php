<?php

namespace App\Console\Commands;

use App\Events\PushNotificationAssignTaskEvent;
use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class TaskDateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task-date:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $taskDate = Carbon::parse($task['taskDate'])->format('Y-m-d H:i:s');
            $taskDatebefore2Hour = date('Y-m-d H:i:s', strtotime($taskDate . ' -2 hours'));
            $nowDate = date('Y-m-d H:i:s');

            if ($nowDate >= $taskDatebefore2Hour  && $task['taskDate'] != null) {
                event(new PushNotificationAssignTaskEvent($task));
            }
        }

        $this->info('task-date:cron Command Run successfully!');
    }
}
