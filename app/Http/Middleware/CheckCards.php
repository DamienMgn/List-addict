<?php

namespace App\Http\Middleware;

use App\Cards;
use Closure;

class CheckCards
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $params = $request->route()->parameters();

        $cards = Cards::all();

        $card = $cards->find($params['card']);

        if ($card->category->user_id === $request->user()->id) {
            return $next($request);
        }
    }
}
