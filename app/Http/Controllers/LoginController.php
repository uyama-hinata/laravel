<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;


class LoginController extends Controller
{
    /**
     * ログイン画面を表示する
     */
    public function Login()
    {
        return view('user.Login');

    }
    /**
     * ログイン処理(バリデーション)
     */
    public function postLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('topLogin');

    }
}
?>