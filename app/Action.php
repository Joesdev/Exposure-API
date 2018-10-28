<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'hierarchy_id', 'level', 'description', 'fear_average'
    ];

}
