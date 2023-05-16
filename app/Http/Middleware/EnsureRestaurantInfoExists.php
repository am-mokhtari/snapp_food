<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class EnsureRestaurantInfoExists
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = Auth::user()->id;
        $restaurants = Restaurant::where('user_id', $id)->get();
        $unavailableInfo = true;

        foreach ($restaurants as $restaurant) {
            $unavailableInfo = false;
            if (
                empty($restaurant->id) ||
                empty($restaurant->name) ||
                empty($restaurant->user_id) ||
                empty($restaurant->type_id) ||
                empty($restaurant->phone_number) ||
                empty($restaurant->address) ||
                empty($restaurant->account_number)
            ) {
                return Redirect::route('restaurant.info.edit', [$restaurant->id]);
            }
        }

        if ($unavailableInfo) {
            return Redirect::route('restaurant.info.edit', [0]);
        }
        return $next($request);
    }
}
