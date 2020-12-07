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
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'brand'       => $this->brand,
            'name'        => $this->name,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'description' => $this->description,
            'image'       => $this->image,
            'enabled'     => $this->enabled,
            'created'     => $this->created_at->diffForHumans(),
            'created_at'  => $this->created_at->format('d-m-y'),
            'updated_at'  => $this->updated_at->format('d-m-y'),
        ];
    }
}
