<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public function addAction($action)
    {
        if($action instanceof Action){
            return $this->actions()->save($action);
        }else if($action instanceof Collection){
            return $this->actions()->saveMany($action);
        } else{ //Assoc Array
            $this->actions()->create($action);
        }
    }

    public function countActions()
    {
        return $this->actions()->count();
    }
}
