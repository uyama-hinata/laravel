<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\Hankaku;
use App\Rules\Email;
use App\Rules\MatchAuthCode;
use App\Mail\ChangeEmailMail;
use Illuminate\Support\Facades\Session;

class ChangeUserinfoController extends Controller
{
    /**
     * 会員情報変更画面を表示
     */
    public function changeInfo()
    {
        // 現在のユーザーを取得
        $user=Auth::user();

        $first['name_sei']=$user->name_sei;
        $first['name_mei']=$user->name_mei;
        $first['nickname']=$user->nickname;
        $first['gender']=$user->gender;

        return view('mypage.changeInfo',compact('first'));
    }
    /**
     * データを受け渡す(バリデーション)
     */
    public function postInfo(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name_sei'=>'required|max:20',
            'name_mei'=>'required|max:20',
            'nickname'=>'required|max:10',
            'gender'=>'required|in:1,2',
        ]);

        // セッションに入れる
        $request->session()->put('changeInfo_input',$input);
        return redirect()->route('infoConfirm');
    }
    /**
     * 確認画面を表示
     */
    public function infoConfirm(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('changeInfo_input');

        return view('mypage.infoConfirm',compact('input'));
        
    }
    /**
     * 登録する
     */
    public function exeInfo(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('changeInfo_input');

        // 戻るボタン処理
        if($request->has('btn_back')){
            return redirect()->route('changeInfo')
            ->withInput($input);
        }

        // 現在のユーザーを取得
        $user=Auth::user();

        // データベースに上書きの処理
        $user->name_sei=$input['name_sei'];
        $user->name_mei=$input['name_mei'];
        $user->nickname=$input['nickname'];
        $user->gender=$input['gender'];
        $user->save();

        return redirect()->route('mypage');
    }
    /**
     * パスワード変更画面を表示
     */
    public function changePass()
    {

        return view('mypage.changePass');
    }
    /**
     * 登録する(バリデーション)
     */
    public function exeChangePass(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'password'=>['required','min:8','max:20','confirmed',new Hankaku()],
        ]);
        
        // 現在のユーザーを取得
        $user=Auth::user();

        // データベースに上書きの処理
        $user->password=bcrypt($input['password']);
        $user->save();

        return redirect()->route('mypage');
    }
    /**
     * メールアドレス変更画面を表示
     */
    public function changeEmail()
    {
        // 現在のユーザーのメールアドレスを取得
        $userEmail=Auth::user()->email;
        return view('mypage.changeEmail',compact('userEmail'));
    }
    /**
     * 認証メールを送信する(バリデーション)
     */
    public function sendChangeEmail(Request $request)
    {
        $request->validate([
            'email'=>['required','email','max:200',new Email()],
        ]);

        $newEmail=$request->input('email');
        Session::put('newEmail',$newEmail);

        $user=Auth::user();

        // 新しいメールアドレスに認証メール送信 
        Mail::to($newEmail)->send(new ChangeEmailMail($user));
        
        return redirect()->route('checkCode')->with('status', __('A confirmation email for changing the email address has been sent.'));
    }
    /**
     * 認証コード入力画面を表示
     */
    public function checkCode()
    {
        return view('mypage.checkCode');
    }
    /**
     * コード認証とメールアドレス変更処理
     */
    public function exeChangeEmail(Request $request)
    {
        // 現在のユーザーのコードを取得
        $userAuthcode=Auth::user()->auth_code;
        // セッションから出す
        $newEmail=Session::get('newEmail');
        $user=Auth::user();

        $request->validate([
            'auth_code'=>['required',new MatchAuthCOde($userAuthcode)],
        ]);

        // データベースに上書きの処理
        $user->email=$newEmail;
        $user->auth_code=str_pad(random_int(0,999999),6,0,STR_PAD_LEFT);
        $user->save();

        return redirect()->route('mypage');
    }
}
    