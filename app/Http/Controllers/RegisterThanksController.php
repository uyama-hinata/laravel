<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;




class RegisterThanksController extends Controller
{
    /**
     * 完了画面を表示する
     */
    public function thanks(Request $request)
    {

        return view('user.thanks');
    }
}
?>