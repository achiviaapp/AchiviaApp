<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Events\PushNotificationActionDateEvent;

class ActionsDateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action-date:cron';

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
        $clients = User::join('client_details', 'users.id', '=', 'client_details.userId')->select('users.*', 'client_details.*')->get()->toArray();
        foreach ($clients as $client) {
            $user = User::where('id', $client['userId'])->first();
            $nextAction = Carbon::parse($client['notificationDate'] . $client['notificationTime'])->format('Y-m-d H:i:s');
            $nextActionbefore2Hour = date('Y-m-d H:i:s', strtotime($nextAction . ' -2 hours'));
            $nowDate = date('Y-m-d H:i:s');
            $sale = User::where('id', $client['assignToSaleManId'])->first();
            if ($nowDate >= $nextActionbefore2Hour  && $client['notificationDate'] != null) {
                event(new PushNotificationActionDateEvent($sale, $user));
            }
        }
//
    }
}
