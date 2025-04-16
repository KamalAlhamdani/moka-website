<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->favorite = $this->favorite->count() > 0 ? true : $this-> false;
     return [
            "id"=> $this->id,
            "is_new"=> (bool)$this->is_new,
            "status"=> (bool)$this->status,
            "type"=> $this->type,
            "name"=> $this->name,
            "details"=> $this->details,
            "image"=> domainAsset('storage/thumbnail/'.$this->image), //$this->image,
            "image64"=> domainAsset('storage/thumbnail/64/'.$this->image), //$this->image,
            "image150"=> domainAsset('storage/thumbnail/150/'.$this->image), //$this->image,
            "image360"=> domainAsset('storage/thumbnail/360/'.$this->image), //$this->image,
            "image640"=> domainAsset('storage/thumbnail/640/'.$this->image), //$this->image,
            "taste"=> $this->taste,
            "category"=> $this->category,
            "prices"=> $this->prices,
            "favorite"=> $this->favorite
     ];
        return parent::toArray($request);
    }
}
