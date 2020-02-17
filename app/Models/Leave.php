<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';
    protected $fillable = array('leave_days' , 'status' , 'reason' , 'userId', 'note', 'start_date', 'end_date');



    public function user()
    {
        return $this->belongsTo('App\User' ,'userId');
    }

}
