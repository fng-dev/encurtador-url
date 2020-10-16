<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TokenService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required"
        ];

        $this->validate($request, $rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        TokenService::createKeyApiToken($user);

        $token = TokenService::createAuthToken($user);

        $user->token = $token->token;

        return response()->json($user);
    }

    public function auth(Request $request)
    {
        $rules = [
            "email" => "required|exists:users,email",
            "password" => "required"
        ];

        $this->validate($request, $rules);

        try {
            $user = User::where('email', $request->email)->first();

            if(Hash::check($request->password, $user->password)) {
                $user->token = TokenService::createAuthToken($user)->token;
                $user->shortener_secret = $user->token()->where('type', 'key')->orderBy('id', 'DESC')->first()->token;
                return response()->json($user);
            }

            throw new Exception("Username or password invalid");

        }catch(Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
