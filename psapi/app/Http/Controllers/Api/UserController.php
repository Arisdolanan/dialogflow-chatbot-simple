<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        $user = auth()->user();

        return response()->json([
            'code' => 1,
            'status' => "success",
            'message' => "Data retrieved",
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at
            ],
        ]);

        // return new DataResource($user);
    }
}
