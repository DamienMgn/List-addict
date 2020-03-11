<?php

namespace App\Http\Middleware;

use Closure;

class CheckCategories
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

        $category = $request->route()->parameters();

        var_dump($category); exit;

        if (! $request->user()->id === $category->user_id) {
            abort(404);
        }

        return $next($request);
    }
}
