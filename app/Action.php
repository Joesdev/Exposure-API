<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Action extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'hierarchy_id', 'level', 'description', 'fear_average'
    ];

    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    public function addPages($pages)
    {
        if($pages instanceof Page){
            return $this->pages()->save($pages);
        }else if ($pages instanceof Collection){
            return $this->pages()->saveMany($pages);
        } else{ //Assoc Array
            return $this->pages()->create($pages);
        }
    }
}
