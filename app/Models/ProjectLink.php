<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLink extends Model
{
    protected $fillable = [
        'link','projectId','alias' , 'campaignId' , 'platform',
    ];

    protected $table = 'project_links';
}
