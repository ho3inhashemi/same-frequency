<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {   
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);


        return response()->json([
            "status" => true,
            "message" => "User registered successfully",
            "data" => []
        ]);

    }


    public function login(UserLoginRequest $request)
    {   
        $user = User::where("email", $request->email)->first();

        $token = $user->createToken("mytoken")->accessToken;
                
        return response()->json([
            "status" => true,
            "message" => "Login successful",
            "token" => $token,
            "data" => []
        ]);
    }


    public function index()
    {
        $users = User::all()->toArray();

        return response()->json([
            "status" => true,
            "message" => "users list fetched successfully",
            "data" => $users
        ]);
    }

}
