<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Rules\Hankaku;


class AdministersTopController extends Controller
{
    /**
     * 管理者ログイン画面を表示
     */
    public function adminLogin()
    { 
        return view('admin.login');
    }
    /**
     * 管理者ログイン処理(バリデーション)
     */
    public function exeAdminLogin(Request $request)
    {
        
        $credentials=$request->only('login_id','password');

        $request->validate([
            'login_id'=>['required','min:7','max:10',new Hankaku()],
            'password'=>['required','min:8','max:20',new Hankaku()],
        ]);

        if(Auth::guard('admin')->attempt( $credentials)){
            return redirect()->route('adminTop');
        }

        return redirect()->route('adminLogin')
        ->withErrors(['login'=>'ログインIDまたはパスワードが間違っています'])
        ->withInput($request->only('login_id'));
            
    }
    /**
     * トップ画面を表示
     */
    public function adminTop()
    {
        // ログイン中の管理者の情報を取得
        $admin=Auth::guard('admin')->user();

        return view('admin.top',compact('admin'));
    }
    /**
     * ログアウト処理
     */
    public function adminLogout()
    {
        
        Auth::guard('admin')->logout();
        return redirect()->route('adminLogin');
        
    }
}