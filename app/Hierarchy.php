<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Mockery\Exception;

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
        //Guard Against going over limit
        $this->guardLimitTen();
        if($action instanceof Action){
            return $this->actions()->save($action);
        }else if($action instanceof Collection){
            return $this->actions()->saveMany($action);
        } else{ //Assoc Array
            return $this->actions()->create($action);
        }
    }

    public function countActions()
    {
        return $this->actions()->count();
    }

    public function guardLimitTen()
    {
        if($this->countActions() == 10){
            throw new Exception();
        }
    }
}
