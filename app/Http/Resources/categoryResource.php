<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class categoryResource extends JsonResource
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
            'products_count' => $this->products_count
        ];
    }
}
