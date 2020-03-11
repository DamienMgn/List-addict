<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TodoController extends Controller
{
    /**
     * Return categories
     */
    public function showCategories(Request $request) {

        $categories =  Categories::where('user_id', $request->user()->id)->get();

        return response()->json([
            'categories' => $categories,
        ]);

    }

    /**
     * Return categories
     */
    public function addCategory(Request $request) {

        $category = new Categories;

        $category->name = $request->name;

        $category->user_id = $request->user()->id;

        $category->save();

        return response()->json([
            'category' => $category,
        ]);
    } 

    /**
     * Return categories
     */
    public function showCards(Request $request, Categories $category) {

            return response()->json([
                'user' => $request->user()->id,
                'categoryUser' => $category
            ]);
    }

}

