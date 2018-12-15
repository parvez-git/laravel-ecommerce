<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'   => $this->name,
            'price'  => $this->price,
            'image'  => $this->image,
            'link'   => route('api.products.show',$this->id)
        ];
    }
}
