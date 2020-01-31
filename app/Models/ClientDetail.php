<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ClientDetailCreatedEvent;

class ClientDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'projectId','viaMethodId', 'actionId','projectCity', 'space','jobTitle', 'address',
        'notes', 'gender','newActionDate', 'newActionTime','clientAgeRange', 'summery','interestsUserProjects',
        'typeClient','ZipCode', 'ip','region', 'country','city','canView','linkView', 'limitView',
        'addedClientFrom', 'addedClientPlatform','addedClientLink', 'assignedTime', 'assignedDate',
        'saleManAssignedToClient', 'assignToSaleManId', 'notificationTime',
        'notificationDate', 'transferred','campaignId','marketerId','platform',
        'property','propertyLocation','propertyUtility','areaFrom','areaTo','budget',
        'deliveryDateId','convertProject1','convertProject2','priority',
        ];

    protected $table = 'client_details';

    public function user()
    {
        return $this->belongsTo('App\User' , 'userId');
    }

    protected $dispatchesEvents = [
        'created' => ClientDetailCreatedEvent::class,
    ];

}
