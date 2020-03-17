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

    /**
     * Return card
     */
    public function addCard(Request $request, Categories $category) {

        $card = new Cards;

        $card->name = $request->cardName;

        $card->category_id = $category->id;

        $card->save();

        return response()->json([
            'card' => $card,
        ]);
    }

    /**
     * Return card
     */
    public function deleteCard(Cards $card) {

        $cardToDelete =  Cards::find($card->id);

        $cardToDelete->delete();

        return response()->json([
            'card' => $card,
        ]);
    }
}
