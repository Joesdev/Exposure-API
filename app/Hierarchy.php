<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hierarchy extends Model
{
    protected $fillable = [
        'user_id', 'goal'
    ];
}
