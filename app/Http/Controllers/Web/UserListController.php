<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\input;



class UserListController extends Controller
{
    /**
     * 会員一覧画面を表示
     */
    public function userList(Request $request)
    {
        // ユーザーの情報を取得
        $query=User::query();

        // デフォルトの並び順
        $query->orderBy('id','desc');

        // IDでの順番切り替え
        if($request->has('order')){
            $order=$request->input('order')=='asc'?'asc':'desc';
            $query->reorder()->orderBy('id',$order);
        }

        // 登録日時での順番切り替え
        if($request->has('dateorder')){
            $order=$request->input('dateorder')=='asc'?'asc':'desc';
            $query->reorder()->orderBy('created_at',$order);
        }

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

        // ▲▼切り替えのため
        $order=$request->input('order','desc');
        $dateorder=$request->input('dateorder','desc');

        $users=$query->paginate(10);

        return view('admin.userList',compact('users','order','dateorder'));
    }
}