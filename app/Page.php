<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'action_id', 'description', 'fear_before', 'fear_during', 'satisfaction'
    ];
}
