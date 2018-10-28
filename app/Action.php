<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'hierarchy_id', 'level', 'description', 'page_id', 'fear_average'
    ];

}
