<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'projectId','templateName' , 'content',
    ];

    protected $table = 'landing_pages';
}
