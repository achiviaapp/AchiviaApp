<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleLog extends Model
{
    protected $fillable = [
        'userId','last_login_at' , 'last_logout_at','sessionId',
    ];

    protected $table = 'sales_logs';
}
