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

    }
    /**
     * データを渡す
     */
    public function postThanks(Request $request)
    {
        $input=$request->session()->get('register_input');

        // トップに戻る
        if($request->has('btn_back')){
            return redirect()->route('topLogin')
            ->with([
                'name_sei'=>$input['name_sei'],
                'name_mei'=>$input['name_mei']
            ]);
        }
    }
}
?>