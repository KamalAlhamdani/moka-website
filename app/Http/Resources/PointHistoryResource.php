<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PointHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //$this->favorite = $this->favorite->count() > 0 ? true : $this-> false;
        return [
                "id"=> $this->id,
                "point"=>  $this->price ,
                'created_at'=>$this->created_at,
                "gain_type"=> $this->GainMethod->GainType->name,
        ];
    }
}
