<?php

namespace App\Listeners;

use App\Events\ClientDetailCreatedEvent;
use App\Events\PushNotificationEvent;
use App\Events\UserSalesUpdatedEvent;
use App\Models\ClientDetail;
use App\Models\ClientHistory;
use App\Models\Project;
use App\Models\RotationAuto;
use App\Models\Team;
use App\User;

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
                    $teamleader = User::where('id', $team['teamLeaderId'])->get()->toArray();
                    $sales[] = $teamleader;
                    $sales[] = $team->teamLeader->sales()->get()->toArray();
                }
                $selectedSales = call_user_func_array("array_merge", $sales);
                $mySelectedSales = $this->checkSales($selectedSales);
//
                foreach ($mySelectedSales as $sale) {
                    if (($sale['lastAssigned'] == 0 || $sale['weight'] > $sale['lastAssigned']) && $sale['assign'] == 0) {
                        ClientDetail::where('userId', $client['userId'])
                            ->update([
                                'assignToSaleManId' => $sale['id'],
                                'assignedDate' => now()->format('Y-m-d'),
                                'assignedTime' => now()->format('H:i:s'),
                            ]);

                        $saleMan = User::where('id', $sale['id']);
                        $saleMan->update(['lastAssigned' => ($sale['lastAssigned'] + 1)]);
                        $date = null;
                        if ($client['notificationDate']) {
                            $date = $client['notificationDate'] . ' ' . $client['notificationTime'];
                        }
                        $history = ClientHistory::create([
                            'userId' => $client['userId'],
                            'actionId' => null,
                            'createdBy' => $user['createdBy'],
                            'state' => 'Re assigned',
                            'notes' => $client['notes'],
                            'date' => $date,
                        ]);

                        $sale = $saleMan->first();
                        event(new PushNotificationEvent($sale, $user));
                        event(new UserSalesUpdatedEvent($user));
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