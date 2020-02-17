<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'linkId','templateName' , 'content',
    ];

    protected $table = 'landing_pages';
}
