<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use Illuminate\Http\Request;
use App\Models\Review;

class ProductListController extends Controller
{
    /**
     * サブカテゴリを取得
     */
    public function getSub($key)
    {
        $subcategories=Product_subcategory::where('product_category_id',$key)->get();
        return response()->json($subcategories);
    }
    /**
     * 一覧画面を表示する
     */
    public function productList(Request $request)
    {

        // 一覧から来たということをセッションに入れる
        session(['from_page'=>'list']);
        // 現在のページをセッションに入れる
        session(['previous_page' =>request()->page ?? 1]);

        $categories=Product_category::all();
        $subcategories=Product_subcategory::all();
        $query=Product::query();

        // カテゴリ検索
        if($request->has('search_category') && $request->search_category!=''){
            $query->where('product_category_id',$request->search_category);
        }
        // サブカテゴリ検索
        if($request->has('search_subcategory') && $request->search_subcategory!=''){
            $query->where('product_subcategory_id',$request->search_subcategory);
        }
        // フリーワード検索機能
        if($request->has('search_freeword') && $request->search_freeword!=''){
            $freeword=$request->search_freeword;
            $query->where(function($query)use($freeword){
                $query->where('name','LIKE',"%{$freeword}%")
                      ->orwhere('product_content','LIKE',"%{$freeword}%");
            });
        }

        $products=$query->orderBy('id','desc')->paginate(10);

        // 総合評価
        foreach($products as $product){
        $product->averageEvaluation = Review::where('product_id',$product->id)
        ->selectRaw('FLOOR(AVG(evaluation)) as evaluations')
        ->first();
        }

        return view('product.list',compact('categories','subcategories','products'));
        
    }
    
}