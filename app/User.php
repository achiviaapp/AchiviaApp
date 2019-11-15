<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'userName', 'phone', 'roleId', 'teamId',  'mangerId', 'userStatus',
        'assign', 'saleManPunished', 'saleManAssignedToClient', 'saleManSendingMsgLimit', 'active','createdBy',
    ];

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


    public function getAssignedTime($value)
    {

    }

    public function logs()
    {
        return $this->hasMany('App\Models\log');
    }

    public function history()
    {
        return $this->hasMany('App\Models\clientHistory', 'userId');
    }

    public function role()
    {
        return $this->hasOne('App\Models\role');
    }

    public function detail()
    {
        return $this->hasOne('App\Models\clientDetail' , 'userId');
    }

    public function clients()
    {
        return $this->hasMany('App\user', 'assignToSaleManId')->with('detail');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'teamId');
    }

}