<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return user
     */
    public function showUser(Request $request) {

        $user =  $request->user();

        return response()->json([
            'user' => $user,
        ]);
    }
}
