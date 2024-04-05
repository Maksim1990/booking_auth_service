<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['login']),
        ];
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Authenticate and return token",
     *     tags={"Auth"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::whereEmail($validated['email'])->first();

        if ($user === null || ! Hash::check($validated['password'], $user->password)) {
            throw new AuthenticationException();
        }

        if (! $token = Auth::claims(['userUuid' => $user->uuid])->attempt($validated)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json([
            'user' => Auth::user(),
            'payload' => Auth::payload(),
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        Auth::logout();

        return response()->json(['status' => ResponseStatus::HTTP_OK->value, 'message' => 'Successfully logged out.']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
