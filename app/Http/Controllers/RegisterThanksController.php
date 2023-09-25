<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThanksMail;



class RegisterThanksController extends Controller
{
    /**
     * 完了画面を表示する
     */
    public function thanks(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');

        //メール送信    
        Mail::to($input['email'])->send(new ThanksMail());

        return view('user.thanks');

        // トップに戻る
        if($request->has('btn_back')){
            return redirect()->route('topLogin');
        }
    }
}
?>