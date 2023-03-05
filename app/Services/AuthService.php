<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(?string $name, string $email, string $password, string $type): array
    {
        $user = User::create([
            'name'  =>  $name,
            'email' =>  $email,
            'password' => Hash::make($password),
            'type' => $type
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('Login')->accessToken,
        ];
    }

    public function login(string $email, string $password, string $fcmToken = null): array
    {
        $user = User::where('email', $email)
        ->first();

        if (!$user || !Hash::check($password, $user->password)) throw new Exception('Incorrect email or password.');

        return [
            'user' => $user,
            'token' => $user->createToken('Login')->accessToken,
        ];
    }

    public function logOut(): bool
    {
        return auth()->user()->token()->delete();
    }
}
