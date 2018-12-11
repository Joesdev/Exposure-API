<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Action extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'hierarchy_id' => $this->hierarchy_id,
            'level'        => $this->level,
            'description'  => ucwords($this->description),
            'fear_average' => $this->fear_average
        ];
    }
}
