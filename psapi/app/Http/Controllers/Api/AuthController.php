<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\RegisterResource;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => Str::random(60),
        ]);

        // return response()->json($user);
        return (new RegisterResource($user))->response()->setStatusCode(200);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $currentUser = auth()->user();

            return new UserResource($currentUser);
        }

        return response()->json([
            "code" => 0,
            "status" => "failed",
            "message" => "Credential Failed"
        ], 406);
    }
}
