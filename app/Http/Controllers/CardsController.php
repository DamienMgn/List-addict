<?php

namespace App\Http\Controllers;

use App\Cards;
use App\Categories;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Return cards
     */
    public function showCards(Request $request, Categories $category) {

        $cards =  Cards::where('category_id', $category->id)->get();

        return response()->json([
            'cards' => $cards,
        ]);

    }
}
