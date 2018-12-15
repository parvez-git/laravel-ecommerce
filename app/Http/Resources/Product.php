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
        return [
            'name'          => $this->name,
            'price'         => $this->price,
            'image'         => $this->image,
            'description'   => $this->description,
            'category' => [
                'url'       => route('api.product.category',$this->category->id),
                'name'      => $this->category->name
            ]
        ];
    }
}
