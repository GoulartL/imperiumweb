<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\User;

class UserController extends Controller
{
    public function login()
    {
        return view('system.login.login');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Campo e-mail é obrigatório',
            'password.required' => 'Campo senha é obrigatório'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('system.home');
        } else {
            return redirect()->back()->with('danger', 'E-mail ou senha inválida');
        }
    }
}
