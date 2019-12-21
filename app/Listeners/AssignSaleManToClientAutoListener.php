<?php

namespace App\Listeners;

use App\Events\ClientDetailCreatedEvent;
use App\Models\ClientDetail;
use App\Models\Project;
use App\Models\RotationAuto;
use App\Models\Team;
use App\User;
use App\Models\ClientHistory;
use Illuminate\Support\Facades\Auth;
use App\Events\UserSalesUpdatedEvent;

class AssignSaleManToClientAutoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(ClientDetailCreatedEvent $event)
    {
        $client = $event->user;
        $user = User::where('id', $client['userId'])->first();
        if ($client['assignToSaleManId'] != 0) {
            return;
        } else {
            $rotationType = RotationAuto::first()['type'];
            if ($rotationType == 1 && $client['projectId']) {
                $project = Project::find($client['projectId']);
                $teams = $project->teams()->get()->toArray();
                $sales = [];
                foreach ($teams as $team) {
                    $team = Team::find($team['id']);
                    $teamleader = User::where('id',  $team['teamLeaderId'])->get()->toArray();
                    $sales[] = $teamleader;
                    $sales[] = $team->sales()->get()->toArray();

                }

                $selectedSales = call_user_func_array("array_merge", $sales);
                $mySelectedSales = $this->checkSales($selectedSales);
//
                foreach ($mySelectedSales as $sale) {
                    if (($sale['lastAssigned'] == 0 || $sale['weight'] > $sale['lastAssigned']) && $sale['assign'] == 0) {
                        ClientDetail::where('userId', $client['userId'])->update(['assignToSaleManId' => $sale['id']]);

                        event(new UserSalesUpdatedEvent($user));

                        $history = ClientHistory::create([
                            'userId' => $client['userId'],
                            'actionId' => 0,
                            'createdBy' => Auth::user()->id,
                            'state' =>  'assigned',
                        ]);
                        User::where('id', $sale['id'])->update(['lastAssigned' => ($sale['lastAssigned'] + 1)]);
                        return;
                    }
                }

            }
        }
    }

    public function checkSales($sales)
    {

        $notAssigned = [];
        foreach ($sales as $sale) {

            if ($sale['lastAssigned'] == 0) {
                $notAssigned[] = $sale['id'];
            }
        }

        $counter = count($notAssigned);
        if ($counter == 0) {
            foreach ($sales as $oneSale) {
                $user = User::where('id', $oneSale['id'])->first();
                if ($user) {
                   $user->lastAssigned = 0;
                   $user->save();
                }

                $mySelectedSales[] = $user->toArray();
            }
        } else {
            $mySelectedSales = $sales;
        }

        asort($mySelectedSales);
        return $mySelectedSales;

    }
}