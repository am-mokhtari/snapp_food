<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            "type" => $this->type->title,
            "phone_number" => $this->phone_number,
            "address" => $this->address->only([
                'address',
                'latitude',
                'longitude',
            ]),
            "is_open" => (boolean) $this->is_open,
            "score" => $this->score,
        ];
    }
}
