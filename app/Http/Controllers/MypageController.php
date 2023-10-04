<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MypageController extends Controller
{
    /**
     * マイページを表示
     */
    public function mypage()
    {
        // 現在のログインユーザーを取得
        $user= Auth::user();

        return view('mypage.mypage',compact('user'));
    }
    /**
     * 退会ページを表示
     */
    public function delete()
    {
        
        return view('mypage.delete');
    }
    /**
     * 退会処理
     */
    public function exeDelete()
    {
        $user= Auth::user();
        $user->delete();
        Auth::logout();
        return redirect(route('topLogout'));
    }
}
    
