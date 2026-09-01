<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getDataUser()
    {
        $user = Auth::user();

        $payload = [
            'id' => $user->id,
            'name' => $user->first_name . $user->last_name,
            'email' => $user->email,
            'is_verified' => $user->email_verified_at !== null ? true : false,
        ];
        return $payload;
    }

    public function changePasswordUser(array $data)
    {
        $id = Auth::id();
        $result = $this->userRepository->getById($id);
        if (!$result) throw new Exception('Usuario no encontrado.');

        if (!Hash::check($data['old_password'], $result->password)) throw new Exception('La contraseña actual no coincide');

        $payload = [
            'password' => Hash::make($data['password']),
        ];
        $user = $this->userRepository->update($id, $payload);

        if (!$user) throw new Exception('Error al actualizar contraseña');
        return $user;
    }

    public function deleteAccountUser()
    {
        $id = Auth::id();
        $result = $this->userRepository->getById($id);
        if (!$result) throw new Exception('Usuario no encontrado.');

        $user = $this->userRepository->delete($id);

        return $user;
    }
}
