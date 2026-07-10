<?php

namespace App\Http\Controllers;

use App\Http\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profileViewGeneral()
    {
        try {
            $user = $this->profileService->getDataUser();

            return view('pages.profile.profile-general', [
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8',
        ], [

            'old_password.required' => 'La contraseña actual es obligatorio.',
            'old_password.min' => 'La contraseña actual debe tener al menos :min caracteres.',

            'password.required' => 'La nueva contraseña es obligatorio.',
            'password.min' => 'La nueva contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las nuevas contraseñas no coinciden.'
        ]);
        try {

            $this->profileService->changePasswordUser($validated);

            return back()->with([
                'success' => 'Contraseña cambiado exitosamente.'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $this->profileService->deleteAccountUser();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}
