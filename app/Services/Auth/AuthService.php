<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * @param array $data
     * @return User
     */
    public function register(array $data):User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data) : array
    {
        if (! Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('crm-api')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];

    }
}
