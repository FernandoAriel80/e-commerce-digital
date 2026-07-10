<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ], [
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo tiene que ser de cormato correo.',

            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña tiene que tener 8 caracteres como minimo.'
        ]);

        try {
            $user = $this->authService->loginUser($validated);

            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'cf-turnstile-response' => 'required'
        ], [
            'first_name.required' => 'El nombre es requerido.',
            'first_name.max' => 'La máxima cantidad de caracteres es de 50.',
            'last_name.required' => 'El apellido es requerido.',
            'last_name.max' => 'La máxima cantidad de caracteres es de 50.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El formato del correo debe ser valido.',
            'password.required' => 'La contraseña es requerida.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener un mínimo de 8 caracteres.',
        ]);
        try {
            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => env('RE_CAPTCHA_CLOUDFLARE_SECRET_KEY'),
                'response' => $request->input('cf-turnstile-response'),
            ]);

            if (!$response->json('success')) {
                return back()->withErrors(['error' => 'Error de verificación']);
            }

            $user = $this->authService->registerUser($validated);
            //dd($user);
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('verification.notice');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'El correo es requerido.',
                'email.email' => 'El correo tiene que ser formato correo.'
            ]
        );

        $status = $this->authService->forgotPasswordUser($request);

        $messages = [
            \Illuminate\Support\Facades\Password::RESET_LINK_SENT => 'Hemos enviado el enlace de recuperación a tu correo electrónico.',
            \Illuminate\Support\Facades\Password::INVALID_USER => 'No encontramos un usuario con ese correo electrónico.',
            \Illuminate\Support\Facades\Password::RESET_THROTTLED => 'Por favor, espera antes de reintentar.',
        ];
        if ($status === 'is_id_google') {
            return back()->with('status', 'Esta correo esta iniciado con google');
        }

        if ($status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            return back()->with('status', $messages[$status]);
        }

        return back()->withErrors(['email' => $messages[$status]]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El formato tiene que ser de tipo correo.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'Tiene que ser como min de :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ]);
        $status = $this->authService->resetPasswordUser($request);

        $messages = [
            \Illuminate\Support\Facades\Password::PASSWORD_RESET => 'Tu contraseña ha sido restablecida correctamente.',
            \Illuminate\Support\Facades\Password::INVALID_USER => 'No encontramos un usuario con ese correo electrónico.',
            \Illuminate\Support\Facades\Password::INVALID_TOKEN => 'El token es inválido o ha expirado.',
            \Illuminate\Support\Facades\Password::RESET_THROTTLED => 'Por favor, espera antes de reintentar.',
        ];

        if ($status === \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', $messages[$status]);
        }

        return back()->withErrors(['email' => $messages[$status]]);
    }

    public function emailVerify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $this->authService->emailVerifyUser();
        return redirect('/')->with('success', '¡Email verificado correctamente!');
    }

    public function emailNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', '¡Enlace de verificación reenviado!');
    }
}
