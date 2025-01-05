<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function create_user(Request $request){


        // $user_exsist = User::where("email", $request->email)->first();
        // if ($user_exsist){
        //     return response(
        //         ["message"=> "Failed!"],Response::HTTP_FAILED_DEPENDENCY
        //     );
        // } -> this portion is no longer needed! it's checking on validation!


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

    public function login(Request $request){
        $fields = $request -> validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where("email", $fields["email"])->first();
        
        if ($user){
            $password_check = Hash::check($fields['password'], $user->password);
            if (!$password_check){
                return response([
                    "message"=>"bad crad"
                ], 401) ;
            };
        }else{
            return response([
                "message"=> "login error"
            ] ,401) ;
        }

        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'message' => "logged in!",
            'user'=> $user,
            'token'=> $token
        ];
        return response($response, 200);
    }
}
