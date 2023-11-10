<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            //asset('storage' . '\product_images\JbpQ9HOFmZM9pHZcejebMqax7nSga0Yyv0S13eco.jpg'),

            'image' => $this->image,
            'category' => $this->category->name,
            'price' => number_format($this->price / 100, 2)



        ];
    }
}
