<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;


class PasswordResetLinkController extends Controller
{
    /**
     * メール入力画面を表示する
     */
    public function passwordMail():View
    {
        return view('user.passwordMail');
    }
    /**
     * メール送信処理
     */
    public function sendMail(Request $request): RedirectResponse
    {
        $input=$request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        //メール送信 
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? redirect()->route('sentMail')
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
    /**
     * メール送信完了画面を表示する
     */
    public function sentMail():View
    {
        return view('user.sentMail');
    }
}
?>