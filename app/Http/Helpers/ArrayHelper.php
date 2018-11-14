<?php
namespace App\Http\Helpers;

class ArrayHelper
{
    protected $masterArray = [];
    protected $count;

    function __construct($masterArray)
    {
        $this->masterArray = $masterArray;
        $this->count = count($this->masterArray);
        $this->randomize();
    }

    public function randomize(){
        shuffle($this->masterArray);
    }

    public function getRandomElement()
    {
        $element = array_pop($this->masterArray);
        $this->count--;
        return $element;
    }

    public function getCount()
    {
        return $this->count();
    }

    public function guardEmptyArray()
    {
        if($this->getCount() == 0){
            throw new \Exception('Array is Empty');
        }
    }
}