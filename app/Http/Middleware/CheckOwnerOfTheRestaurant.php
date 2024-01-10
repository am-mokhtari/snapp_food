<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOwnerOfTheRestaurant
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::id() !== Restaurant::find($request['id'])->user_id){
            return to_route('dashboard');
        }
        return $next($request);
    }
}
