<?php

namespace App\Http\Resources;

use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => Number::doReadable($this->price),
            "ingredient" => empty($this->ingredient) ? "none" :  $this->ingredient,
            "picture" => empty($this->picture) ? "none" :  $this->picture,
        ];
    }
}
