<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Quote extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toarray($request);
        
        return [
            'id'=>$this->id,
            'quote'=>$this->quote,
            'title'=>$this->title,
            'year'=>$this->year,
        ];
    }
}
