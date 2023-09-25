<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_sei'=>'required|string|max:20',
            'name_mei'=>'required|string|max:20',
            'nickname'=>'required|string|max:10',
            'gender'=>'required|in:1,2',
            'password'=>'required|alpha_num|min:8|max:20|confirmed',
            'email'=>'required|string|email|max:200|unique:users,email,'
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);


        if($validator->fails()){
            return redirect()->route('register')
            ->withInput()
            ->withErrors($validator);
        }
        
        // セッションに入れる
        $request->session()->put('register_input',$input);
        return redirect()->route('confirm');
    }
    /**
     * 確認画面を表示
     */
    public function confirm(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');

        // セッションに値がないときはregisterに戻る
        if(!$input){
            return redirect()->route('register');
        }
        return view('member.confirm',['input'=>$input]);
    }
    /**
     * 登録する
     */
    public function exeRegist(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');

        // セッションに値がないときはregistに戻る
        if(!$input){
            return redirect()->route('register');
        }

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('register')
        ->withInput($input);
        }

        // データベースに登録の処理
        $user=new user();
        $user->name_sei=$input['name_sei'];
        $user->name_mei=$input['name_mei'];
        $user->nickname=$input['nickname'];
        $user->gender=$input['gender'];
        $user->password=bcrypt($input['password']);
        $user->email=$input['email'];
        $user->save();

        // 新しいユーザーをログインさせる
        Auth::login($user);

        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('thanks');
    }
    /**
     * 完了画面を表示する
     */
    public function thanks(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');

        //メール送信    
        Mail::to($input['email'])->send(new ThanksMail());

        return view('member.thanks');

    }
}
