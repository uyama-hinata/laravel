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


class TopController extends Controller
{
    /**
     * トップ（ログイン）画面を表示する
     */
    public function topLogin(Request $request)
    {
        // 現在のログインユーザーを取得
        $user= Auth::user();
        // 新規会員登録から来たユーザー
        $input=$request->session()->get('register_input');
        
        return view('user.topLogin',[
            'input'=>$input,
            'user'=>$user
        ]);
        
        // ログアウト画面へ
        if($request->has('toLogout_btn')){
            
            Auth::guard('web')->logout();
            // セッションを無効化
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('topLogout');
        }
    }
    /**
     * トップ（ログアウト）画面を表示する
     */
    public function topLogout(Request $request)
    {
        return view('user.topLogout');

        // 新規会員登録へ
        if($request->has('toRegist_btn')){
            return redirect()->route('userRegister');
        }

        // ログイン画面へ
        if($request->has('toLogin_btn')){
            return redirect()->route('Login');
        }
    }
}
?>