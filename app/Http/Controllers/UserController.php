<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

    /**
     * Return user
     */
    public function updateUser(Request $request) {

        $user =  User::find($request->user()->id);

        $validatedData = $request->validate([
            'name' => 'nullable|min:2|max:25',
            'email' => 'email|nullable|min:3|max:100',
            'picture' => 'nullable'
        ]);


        if (!empty($request->name)) {
            $user->name = $request->name;
        }

        if (!empty($request->email)) {
            $user->email = $request->email;
        }

        if (!empty($request->picture)) {
            Storage::disk('local')->put('new.jpg', $request->picture);
        }

        $user->save();

        return response()->json([
            'user' => $user,
        ]);
    }
}
