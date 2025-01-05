<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create_user(Request $request){
        $fields = $request -> validate([
            'name' => 'required|string',
            'email'=> 'required|string|unique:users,email', // users table, email field
            'password' => 'required|string|confirmed', // confirmation field as well
        ]);

        $user = User::create([
            'name'=> $fields['name'],
            'email'=> $fields['email'],
            'password'=> bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token'=> $token
        ];

        return response($response, 201);
    }
}
