<?php

namespace App\Http\Services;

use App\Events\EmailRegistedEvent;
use App\Http\Repositories\UserRepository;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class AuthService
{

    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginUser(array $data)
    {
        $user = $this->userRepository->getByEmail($data['email']);
        if (!$user) throw new Exception('Datos no coinciden usuario.');
        $password_valid = Hash::check($data['password'], $user->password);

        if (!$password_valid) throw new Exception('Datos no coinciden.');

        return $user;
    }

    public function registerUser(array $data)
    {
        DB::beginTransaction();
        $user = null;
        try {
            $existingUser = $this->userRepository->getByEmail($data['email']);
            if ($existingUser) {
                //dd(!$existingUser->password);
                if (!$existingUser->password) {
                    //dd('entro');
                    $payload = [
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'password' => Hash::make($data['password']),
                        'email_verified_at' => null

                    ];
                    $updateUser = $this->userRepository->update($existingUser->id, $payload);
                    if (!$updateUser) throw new Exception('error al registrar usuario por google.');
                    $user = $updateUser->refresh();
                } else {
                    throw new Exception('Este correo ya está registrado.');
                }
            } else {
                $payload = [
                    'id' => (string) Uuid::uuid4(),
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => 'customer',
                    'is_active' => true,
                ];

                $user = $this->userRepository->create($payload);
                if (!$user) throw new Exception('error al registrar usuario.');
            }

            event(new Registered($user));
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function forgotPasswordUser($request)
    {

        $data = $request->only('email');
        $user = $this->userRepository->getByEmail($data['email']);
        if ($user->google_id  !== null) {
            return 'is_id_google';
        }
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status;
    }


    public function resetPasswordUser($request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        return $status;
    }

    public function emailVerifyUser()
    {
        $user = Auth::user();
        event(new EmailRegistedEvent($user));
    }
}
