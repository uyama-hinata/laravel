<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Rules\Hankaku;
use App\Rules\Email;
use Illuminate\Support\Facades\Auth;


class RegisteredUserController extends Controller
{
    private $formitems = ['name_sei','name_mei','nickname','gender','password','password_confirmation','email'];
    /**
     * 会員登録画面を表示する
     */
    public function userRegister()
    {
        return view('user.register');
    }
    /**
     * データを受け渡す(バリデーション)
     */
    public function postData(Request $request)
    {
        $input=$request->only($this->formitems);
        $userId=null;
        $validatorRules = [
            'name_sei'=>'required|max:20',
            'name_mei'=>'required|max:20',
            'nickname'=>'required|max:10',
            'gender'=>'required|in:1,2',
            'password'=>['required','min:8','max:20','confirmed',new Hankaku()],
            'email'=>['required','email','max:200','unique:users','email',new Email()],
        ];
        
        $validator=Validator::make($input,$validatorRules);

        if($validator->fails()){
            return redirect()->route('userRegister')
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

        // セッションに値がないときはregistに戻る
        if(!$input){
            return redirect()->route('userRegister');
        }
        return view('user.confirm',['input'=>$input]);
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
            return redirect()->route('userRegister');
        }

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('userRegister')
        ->withInput($input);
        }

        // データベースに登録の処理
        $user=new User();
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
}

