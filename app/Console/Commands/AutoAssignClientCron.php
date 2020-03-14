<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AutoAssignService;
use App\User;
use Carbon\Carbon;

class AutoAssignClientCron extends Command
{
    private $autoAssign;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-assign:cron';

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
    public function __construct(AutoAssignService $autoAssign)
    {
        parent::__construct();
        $this->autoAssign = $autoAssign;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clients = User::with('detail')->whereHas('detail', function ($q) {
            $q->where('actionId', null)->where('assignToSaleManId', null);
        })->get()->toArray();
        foreach ($clients as $client) {
            $this->autoAssign->autoAssign($client['detail']);
        }
    }
}
