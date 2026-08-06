<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
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

    /**
     * @param User $user
     * @return void
     */
    public function logout(User $user)
    {
        $user->currentAccessToken()->delete();
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateProfile(User $user, array $data):User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        return $user->refresh();
    }

    /**
     * @param User $user
     * @param array $data
     * @return void
     */
    public function changePassword(User $user, array $data): void
    {
        if (! Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param $data
     * @return void
     */
    public function forgotPassword($data): void
    {
        $status = Password::sendResetLink([
            'email' => $data['email'],
        ]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }
    }

    /**
     * @param $data
     * @return void
     */
    public function resetPassword($data): void
    {
        $status = Password::reset(
            $data,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }
    }
}
