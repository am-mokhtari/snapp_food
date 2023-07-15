<?php

namespace App\Http\Resources;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this[0]['id'],
            "items" => CartItemsResource::collection($this[1]),
            "created_at" => $this[0]->created_at,
            "updated_at" => $this[0]->updated_at,
        ];
    }
}
