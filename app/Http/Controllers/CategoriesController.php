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

        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'color' => 'required|max:7|min:7',
        ]);

        $category = new Categories;

        $category->name = $request->name;

        $category->color = $request->color;

        $category->user_id = $request->user()->id;

        $category->save();

        return response()->json([
            'category' => $category,
        ]);
    }

    /**
     * Return category
     */
    public function updateCategory(Request $request, Categories $category) {

        $validatedData = $request->validate([
            'name' => 'nullable|max:50',
            'color' => 'nullable|max:7|min:7',
        ]);

        if (!empty($request->name)) {
            $category->name = $request->name;
        }
        
        if (!empty($request->color)) {
            $category->color = $request->color;
        }

        $category->save();

        return response()->json([
            'category' => $category,
        ]);
    }

    /**
     * Return category
     */
    public function deleteCategory(Categories $category) {
        $categoryId = $category->id;

        $categoryToDelete =  Categories::find($category->id);

        $categoryToDelete->delete();

        return response()->json([
            'categoryId' => $categoryId,
        ]);
    }
}

