<?php

namespace App\Http\Controllers;

use App\Cards;
use App\Categories;
use App\Tasks;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Return cards
     */
    public function showCards(Categories $category) {

        $cards =  Cards::where('category_id', $category->id)->orderBy('order', 'asc')->get();


        foreach ($cards as $card) {
            $card['tasks'] = Tasks::where('card_id', $card->id)->orderBy('order', 'asc')->get();
        }

        return response()->json([
            'cards' => $cards,
        ]);
    }

    /**
     * Return card
     */
    public function addCard(Request $request, Categories $category) {

        $validatedData = $request->validate([
            'cardName' => 'required|max:50',
            'cardColor' => 'required|max:7|min:7',
        ]);

        $card = new Cards;

        $card->name = $request->cardName;

        $card->color = $request->cardColor;

        $card->category_id = $category->id;

        $card->save();

        return response()->json([
            'card' => $card,
        ]);
    }

    /**
     * Return card
     */
    public function updateCard(Request $request, Cards $card) {

        $validatedData = $request->validate([
            'cardName' => 'nullable|max:50',
            'cardColor' => 'nullable|max:7|min:7',
        ]);

        if (!empty($request->cardName)) {
            $card->name = $request->cardName;
        }

        if (!empty($request->cardColor)) {
            $card->color = $request->cardColor;
        }

        $card->save();

        $card['tasks'] = Tasks::where('card_id', $card->id)->orderBy('order', 'asc')->get();

        return response()->json([
            'card' => $card,
        ]);
    }

    /**
     * Return card
     */
    public function updateCardsOrder(Request $request, Categories $category) {

        $requestCards = $request->cards;

        foreach ($requestCards as $newCard) {
                $card = Cards::find($newCard['id']);
                $card->order = $newCard['order'];
                $card->save();
            }

        $cards =  Cards::where('category_id', $category->id)->orderBy('order', 'asc')->get();

        foreach ($cards as $card) {
            $card['tasks'] = Tasks::where('card_id', $card->id)->orderBy('order', 'asc')->get();
        }

        return response()->json([
            'cards' => $cards
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
