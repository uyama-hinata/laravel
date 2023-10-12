<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;




class UserListController extends Controller
{
    /**
     * 会員一覧画面を表示
     */
    public function userList(Request $request)
    {
        // ユーザーの情報を取得
        $query=User::query();

        // // ソート条件の初期値
        // $sortField='id';
        // $sortOrder='desc';

        // // リクエストに基づいてソートを指定
        // if($request->has('order') && $request->has('field')){
        //     $sortField=$request->input('field');
        //     $sortOrder=$request->iinput('order')=='asc' ? 'asc' :'desc';
        // }

        // $query->orderBy($sortField,$sortOrder);

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
        // 性別検索
        if($request->filled('search_gender')){
            $gender=$request->input('search_gender');
            if(is_array($gender) && count($gender)<2){
            $query->whereIn('gender',$gender);
            }
        }
        // フリーワード検索
        if($request->filled('search_freeword')){
            $freeword=$request->search_freeword;
            $query->where(function($query)use($freeword){
                $query->where('name_sei','LIKE',"%{$freeword}%")
                      ->orwhere('name_mei','LIKE',"%{$freeword}%")
                      ->orwhere('email','LIKE',"%{$freeword}%");
            });
        }

        // セッションに検索条件を入れる
        $request->session()->put('search_id', $request->input('search_id'));
        $request->session()->put('search_gender', $request->input('search_gender'));
        $request->session()->put('search_freeword', $request->input('search_freeword'));

        $users=$query->paginate(10);

        return view('admin.userList',compact('users','sortField','sortOrder'));
    }
}