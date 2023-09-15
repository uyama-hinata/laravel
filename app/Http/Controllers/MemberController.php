<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThanksMail;


class MemberController extends Controller
{
    private $formitems = ['name_sei','name_mei','nickname','gender','password','password_confirmation','email'];
    /**
     * 会員登録画面を表示する
     */
    public function memberRegist():View
    {
        return view('member.regist');
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
            'password'=>'required|alpha_num|min:8|max:20|confirmed|regex:/^[a-zA-Z0-9]+$/',
            'email'=>'required|email|max:200|unique:members,email,' . $userId . '|regex:/^[a-zA-Z0-9]+$/',
        ];
        
        $validator=Validator::make($input,$validatorRules);

        if($validator->fails()){
            return redirect()->route('memberRegist')
            ->withInput()
            ->withErrors($validator);
        }
        
        // セッションに入れる
        $request->session()->put('regist_input',$input);
        return redirect()->route('confirm');
    }
    /**
     * 確認画面を表示
     */
    public function confirm(Request $request):View
    {
        // セッションから取り出す
        $input=$request->session()->get('regist_input');

        // セッションに値がないときはregistに戻る
        if(!$input){
            return redirect()->route('memberRegist');
        }
        return view('member.confirm',['input'=>$input]);
    }
    /**
     * 登録する
     */
    public function exeRegist(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('regist_input');

        // セッションに値がないときはregistに戻る
        if(!$input){
            return redirect()->route('memberRegist');
        }

         // 戻るボタン処理
         if($request->has('btn_back')){
            return redirect()->route('memberRegist')
            ->withInput($input);
        }

        // データベースに登録の処理
        $member=new Member();
        $member->name_sei=$input['name_sei'];
        $member->name_mei=$input['name_mei'];
        $member->nickname=$input['nickname'];
        $member->gender=$input['gender'];
        $member->password=bcrypt($input['password']);
        $member->email=$input['email'];
        $member->save();

        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        // セッションにemail入れる
        $request->session()->put('regist_input_email',$input);

        return redirect()->route('thanks');
    }
    /**
     * 完了画面を表示する
     */
    public function thanks(Request $request)
    {
        // セッションからemail取り出す
        $input=$request->session()->get('regist_input_email');

        //メール送信    
        Mail::to($input['email'])->send(new ThanksMail());

        // セッションを空にする
        $request->session()->forget('regist_input');
        return view('member.thanks');
    }
    
}

