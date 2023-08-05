<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $order = Order::find($this->order_id);
        $foods = $order->foods();
        $foodsNames = [];
        foreach ($foods as $food){
            $foodsNames[] = $food->name;
        }

        return [
            'author' => User::find($this->user_id)->only('name'),
            'foods' => $foodsNames,
            'created_at' => $this->created_at,
            'score' => $order->score,
            'content' => $this->content,
        ];
    }
}
