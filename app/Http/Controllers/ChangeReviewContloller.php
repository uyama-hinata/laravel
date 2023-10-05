<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;



class ChangeReviewContloller extends Controller
{
    /**
     * 商品レビュー管理画面を表示
     */
    public function reviewAdmin()
    {
       
        return view('mypage.reviewAdmin');
    }
}