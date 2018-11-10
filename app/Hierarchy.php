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

    public function addAction($input_fields)
    {
        $this->actions()->create($input_fields);
    }
}
