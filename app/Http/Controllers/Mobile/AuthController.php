<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\Mobile\RegisterRequest;
use App\Http\Requests\Mobile\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a User
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create(
            array_merge(
                $request->validated(),
                ['password' => Hash::make($request->password)]
            )
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->respondWithToken($token);
    }

    /**
     * Log user in via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response(['message' => 'Success'], Response::HTTP_OK);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
}
