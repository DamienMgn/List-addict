<?php

namespace App\Http\Middleware;

use App\Cards;
use App\Categories;
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

        $categoryId = $request->route()->parameters();

        $categories = Categories::all();

        $category =  $categories->find($categoryId['category']);


        if ($request->user()->id === $category->user_id) {
            if(isset($categoryId['card'])) {
                $cards = Cards::all();
                $card = $cards->find($categoryId['card']);
                if($category->id === $card->category_id) {
                    return $next($request);
                }
            }
            return $next($request);
        }


    }
}
