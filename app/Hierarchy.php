<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hierarchy extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'goal'
    ];

    public function actions()
    {
        return $this->hasMany('App\Action');
    }
}
