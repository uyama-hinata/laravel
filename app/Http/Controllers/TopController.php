<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class TopController extends Controller
{
    /**
     * トップ（ログイン）画面を表示する
     */
    public function topLogin(Request $request)
    {
        // セッションクリア
        $request->session()->forget('uploaded_paths');
        
        // 現在のログインユーザーを取得
        $user= Auth::user();
       
        return view('user.topLogin',[
            'user'=>$user
        ]);
        
    }
    /**
     * トップ（ログアウト）画面を表示する
     */
    public function topLogout(Request $request)
    {

        // 新規会員登録へ
        if($request->has('toRegist_btn')){
            return redirect()->route('userRegister');
        }

        // ログイン画面へ
        if($request->has('toLogin_btn')){
            return redirect()->route('Login');
        }

        return view('user.topLogout');
    }
}
?>