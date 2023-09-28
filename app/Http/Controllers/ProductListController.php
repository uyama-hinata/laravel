<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;

class ProductListController extends Controller
{
    /**
     * 一覧画面を表示する
     */
    public function productList(Request $request)
    {
        $categories=Product_category::all();
        $subcategories=Product_subcategory::all();
        $products=Product::all();

        // 検索機能
        $freeword=$request->input('freeword');
        if(!empty($freeword)){
            $products->where('name','LIKE',"%{$freeword}%")
            ->orwhereHas('Product',function($query)use($freeword){
                $query->where('product_content','LIKE',"%{$freeword}%");
            })->get();
        }
        return view('product.list',compact('categories','subcategories'));
        
    }
    /**
     * サブカテゴリを取得
     */
    public function getSub($key)
    {
        $subcategories=Product_subcategory::where('product_category_id',$key)->get();
        return response()->json($subcategories);
    }
}