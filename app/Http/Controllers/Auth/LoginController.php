<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/panel';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        flash()->success('Çıkış işleminiz başarıyla tamamlandı.');
        return redirect()->route('login');
    }


    protected function authenticated(Request $request, $user)
    {
        flash()->success('Giriş işleminiz başarıyla tamamlandı.');
        return redirect()->intended($this->redirectPath());
    }
}
