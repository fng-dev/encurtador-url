<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TokenService {

    public static function createAuthToken(User $user)
    {
        return $user->token()->create([
            'type' => 'auth',
            'token' => Hash::make($user->password . Carbon::now())
        ]);
    }

    public static function createKeyApiToken(User $user)
    {
        return $user->token()->create([
            'type' => 'key',
            'token' => Hash::make($user->password . Carbon::now())
        ]);
    }
}
