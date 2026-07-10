<?php

namespace App\Http\Controllers;

use App\Http\Services\OAthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

//use Laravel\Socialite\Socialite;

class GoogleController extends Controller
{
    private OAthService $oAthService;
    public function __construct(OAthService $oAthService)
    {
        $this->oAthService = $oAthService;
    }

    public function redirect()
    {
        $driver = Socialite::driver('google');

        return $driver->redirect();
    }

    public function callback(Request $request)
    {

        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();
        $user = $this->oAthService->authGoogle($googleUser);

        Auth::login($user);

        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
