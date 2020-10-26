<?php

namespace App\Http\Controllers;

class AuthenticationController extends Controller
{
    public function userLogin()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('auth.login', ['pageConfigs' => $pageConfigs]);
    }
    public function userRegister()
    {
        $pageConfigs = ['bodyCustomClass' => 'register-bg', 'isCustomizer' => false];

        return view('auth.register', ['pageConfigs' => $pageConfigs]);
    }
    public function forgotPassword()
    {
        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];
        return view('auth.passwords.email', ['pageConfigs' => $pageConfigs]);
    }
    public function lockScreen()
    {
        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];

        return view('pages.user-lock-screen', ['pageConfigs' => $pageConfigs]);
    }
}
