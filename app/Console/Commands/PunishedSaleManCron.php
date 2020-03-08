<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class PunishedSaleManCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'punished-sale-man:cron';

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
            $assignDate = $client['assignedDate'] . ' ' . $client['assignedTime'];
            $assignafter2Hour = date('Y-m-d H:i:s', strtotime($assignDate . ' +2 hours'));
            $nowDate = date('Y-m-d H:i:s');
            $sale = User::where('id', $client['assignToSaleManId'])->first();
            $saleMan = User::where('id', $client['assignToSaleManId']);
            if ($assignafter2Hour <= $nowDate && $client['notificationDate'] == null) {
                $saleMan->update([
                    'saleManPunished' => 1,
                    'saleManPunishedTime' => date('Y-m-d H:i:s')
                ]);
            }

            $finishPunishedDate = date('Y-m-d H:i:s', strtotime($sale['saleManPunishedTime'] . ' +1 days'));

            if ($sale['saleManPunished'] == 1 && $nowDate >= $finishPunishedDate) {
                $saleMan->update([
                    'saleManPunished' => null,
                    'saleManPunishedTime' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->info('punished-sale-man:cron Command Run successfully!');
    }
}
