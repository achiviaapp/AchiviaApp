<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Events\UserCreatedEvent;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'userName', 'phone', 'roleId', 'teamId',  'mangerId', 'userStatus',
        'assign', 'saleManPunished', 'saleManSendingMsgLimit', 'active',
        'createdBy','image','lastAssigned', 'weight', 'expireDate',
    ];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $dispatchesEvents = [
        'created' => UserCreatedEvent::class,
    ];


    public function getAssignedTime($value)
    {

    }

    public function logs()
    {
        return $this->hasMany('App\Models\Log');
    }

    public function history()
    {
        return $this->hasMany('App\Models\ClientHistory', 'userId');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'roleId');
    }

    public function detail()
    {
        return $this->hasOne('App\Models\ClientDetail' , 'userId');
    }

    public function notes()
    {
        return $this->hasOne('App\Models\UserNote' , 'userId');
    }

    public function clients()
    {
        return $this->hasMany('App\User', 'assignToSaleManId')->with('detail');
    }

    public function team()
    {
        return $this->hasMany('App\Models\Team','teamLeaderId');
    }


    public function sales()
    {
        return $this->hasMany('App\User','teamId');
    }


    public function campaign()
    {
        return $this->belongsToMany('App\Models\Campaign','campaign_marketers','marketerId', 'campaignId');
    }

    public function leaves() {

        return $this->hasMany('App\Models\Leave');
    }

}
