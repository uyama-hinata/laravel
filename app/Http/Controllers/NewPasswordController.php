<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThanksMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Password;


class NewPasswordController extends Controller
{
    /**
     * パスワード再設定画面を表示する
     */
    public function create():View
    {
        return view('user.resetPass');

    }
    /**
     * パスワード再設定処理
     */
    public function store(Request $request): RedirectResponse
    {
        $input=$request->validate([
            'token' => ['required'],
            'password'=>'required|alpha_num|min:8|max:20|confirmed',
        ]);

        // データベースに登録の処理
        $status = Password::reset(
            $request->only( 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
        
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('topLogin')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);

    }
}
?>