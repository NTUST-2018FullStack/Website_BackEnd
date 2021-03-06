<?php

namespace App\Http\Controllers\Api;

use App\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:members',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|string|same:password',
            ]
        );

        Member::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'success' => true,
        ]);

    }

    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:6',
            ]
        );

        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
//        dd($request);
//        $user = JWTAuth::toUser($request);
        return response()->json(auth('api')->user());
//        return response()->json($user);
    }


//    public function refresh()
//    {
//        return $this->respondWithToken(auth('api')->refresh());
//    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
