<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'restaurant' => $this->restaurant()->first()->name,
            'amount' => $this->amount,
            'order status' => $this->order_status,
            'payment status' => $this->payment_status,
            'tracking code' => $this->tracking_code,
            'foods' => FoodResource::collection($this->foods()),
        ];
    }
}
