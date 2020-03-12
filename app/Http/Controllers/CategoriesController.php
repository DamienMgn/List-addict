<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoriesController extends Controller
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
     * Return category
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
     * Return category
     */
    public function deleteCategory(Request $request, Categories $category) {
        $categoryId = $category->id;

        $categoryToDelete =  Categories::find($category->id);

        $categoryToDelete->delete();

        return response()->json([
            'categoryId' => $categoryId,
        ]);
    } 
}

