<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;




class ReviewListController extends Controller
{
    /**
     * レビュー一覧画面を表示
     */
    public function adminReviewList(Request $request)
    {
        // ユーザーの情報を取得
        $query=Review::query();

        // ソート条件の初期値
        $sortField = 'id';
        $sortOrder = 'desc';

        // ソート条件がリクエストで指定されている場合、それに基づいてクエリを更新
        if ($request->has('order') && $request->has('field')) {
            $sortField = $request->input('field');
            $sortOrder = $request->input('order') == 'asc' ? 'asc' : 'desc';
        }

        $query->orderBy($sortField, $sortOrder);


        // ID検索
        if($request->filled('search_id')){
            $query->where('id',$request->search_id);
        }
        // フリーワード検索
        if($request->filled('search_freeword')){
            $freeword=$request->search_freeword;
            $query->where(function($query)use($freeword){
                $query->where('comment','LIKE',"%{$freeword}%");
            });
        }

        // セッションに検索条件を入れる
        $request->session()->put('search_id', $request->input('search_id'));
        $request->session()->put('search_freeword', $request->input('search_freeword'));

        $reviews=$query->paginate(10);

        return view('admin.reviewList',compact('reviews','sortField','sortOrder'));
    }
}