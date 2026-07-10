<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as GoogleUser;
use Ramsey\Uuid\Uuid;

class OAthService
{
    public function __construct() {}

    public function authGoogle(GoogleUser $googleUser)
    {
        DB::beginTransaction();
        try {

            $email = $googleUser->getEmail();
            $googleId = $googleUser->getId();

            $user = User::where('google_id', $googleId)->first();

            if ($user) {
                $payload = [
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ];
                $user->update($payload);
                return $user;
            }

            $user = User::where('email', $email)->first();
            if ($user) {
                $payload = [
                    'google_id' => $googleId,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ];
                $user->update($payload);
                return $user;
            }

            $payload = [
                'id' => (string) Uuid::uuid4(),
                'first_name' => $googleUser->getName(),
                'last_name' => '',
                'email' => $email,
                'google_id' => $googleId,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'role' => 'customer',
                'is_active' => true,
                'email_verified_at' => now(),
            ];
            $user = User::create($payload);
            if (!$user) throw new Exception('error al registrar usuario.');
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
