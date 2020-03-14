<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 11/14/19
 * Time: 3:56 PM
 */

namespace App\Imports;

use App\Events\UserSalesUpdatedEvent;
use App\Models\ClientDetail;
use App\Models\ClientHistory;
use App\Models\UserNote;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Events\NewAssignNotificationEvent;


class ImportClients implements ToModel
{
    private $myData;

    public function __construct($data)
    {
        $this->myData = $data;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $cols = $this->myData;
        $phone = $row[$cols['codeCol'] - 1] . $row[$cols['phoneCol'] - 1];
        $userExist = User::where('phone', $phone)->orWhere('email', $row[$cols['emailCol'] - 1])->first();
        $sale = ClientDetail::where('userId', $userExist['id'])->first();
        $actionId =  $sale['actionId'];

        if ($userExist && $actionId != null) {
            $userExist->duplicated = $userExist->duplicated + 1;
            $sale = User::where('id', $sale['assignToSaleManId'])->first();
            $client = User::where('id', $userExist['id'])->first();
            event(new NewAssignNotificationEvent($sale, $client));
            return $userExist;
        } elseif ($userExist && $actionId == null) {
            return $userExist;
        }

        $userData = array(
            'name' => $row[$cols['nameCol'] - 1],
            'phone' => $phone,
            'email' => $row[$cols['emailCol'] - 1],
            'roleId' => 5,
            'createdBy' => Auth::user()->id,

        );
        $job = '';
        $note = '';

        if (@$row[$cols['jobCol']]) {
            $job = $row[$cols['jobCol'] - 1];
        }
        if (@$row[$cols['notesCol']]) {
            $note = $row[$cols['notesCol'] - 1];
        }

        $user = User::create($userData);
        $userCreated = $user;
        $assignToSaleManId = $cols['saleCol'];
        $assignedDate = now()->format('Y-m-d');
        $assignedTime = now()->format('H:i:s');

        if ($cols['saleCol'] == 0) {
            $assignToSaleManId = null;
            $assignedDate = null;
            $assignedTime = null;
        }
        $clientDetailsData = array(
            'userId' => $user->id,
            'typeClient' => 0,
            'jobTitle' => $job,
            'notes' => $note,
            'platform' => $cols['platformCol'],
            'projectId' => $cols['projectCol'],
            'campaignId' => $cols['campaignCol'],
            'marketerId' => $cols['marketerCol'],
            'assignToSaleManId' => $assignToSaleManId,
            'assignedDate' => $assignedDate,
            'assignedTime' => $assignedTime,

        );
        $state = '';
        if ($cols['saleCol'] != 0) {
            $state = 'Re assigned';
        }
//
//        //insert record
        $user = ClientDetail::create($clientDetailsData);

        if ($cols['saleCol'] != 0) {
            $sale = User::where('id', $cols['saleCol'])->first();
            event(new NewAssignNotificationEvent($sale, $userCreated));
            event(new UserSalesUpdatedEvent($userCreated));
            $date = null;
            if ($user['notificationDate']) {
                $date = $user['notificationDate'] . ' ' . $user['notificationTime'];
            }

            $history = ClientHistory::create([
                'userId' => $user->id,
                'actionId' => null,
                'summery' => $user->summery,
                'viaMethodId' => $user->viaMethodId,
                'createdBy' => Auth::user()->id,
                'state' => $state,
                'notes' => $user['notes'],
                'date' => $date ,
            ]);
        }

        if ($note != '') {
            $note = UserNote::create(['userId' => $user->id, 'note' => $note]);
        }
        return $user;
    }
}

