<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class adminProductListController extends Controller
{
    /**
     * 商品一覧画面を表示
     */
    public function adminProductList(Request $request)
    {
        // カテゴリの情報を取得
        $query=Product::query();


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

        // フリーワード検索
        if($request->filled('search_freeword')){
            $freeword=$request->search_freeword;
            $query->where(function($query)use($freeword){
                $query->where('name','LIKE',"%{$freeword}%")
                      ->orwhere('product_content','LIKE',"%{$freeword}%");
                      });
        }

        // セッションに検索条件を入れる
        $request->session()->put('search_id', $request->input('search_id'));
        $request->session()->put('search_freeword', $request->input('search_freeword'));

        // ▲▼切り替えのため
        $order=$request->input('order','desc');
        $dateorder=$request->input('dateorder','desc');

        $products=$query->paginate(10);


        return view('admin.productList',compact('products','order','dateorder'));
    }
}