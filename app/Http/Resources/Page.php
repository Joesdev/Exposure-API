<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
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
            'action_id'    => $this->action_id,
            'description'  => $this->description,
            'fear_before'  => $this->fear_before,
            'fear_during'  => $this->fear_during,
            'satisfaction' => $this->satisfaction
        ];
    }
}
