<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;

class ProductDetailController extends Controller
{
    /**
     * 詳細を表示する
     */
    public function productDetail($id)
    {
        $product = Product::find($id);

        // idが空の時はリストへ
        if(is_null($product)){
            return redirect('productList');
        }

        // IDをセッションに入れる
        session(['product_id'=>$id]);
        session(['name'=>$product->name]);
        session(['image_1'=>$product->image_1]);
        session(['image_2'=>$product->image_2]);
        session(['image_3'=>$product->image_3]);
        session(['image_4'=>$product->image_4]);

        $averageEvaluation = Review::where('product_id',$id)
        ->selectRaw('FLOOR(AVG(evaluation)) as evaluations')
        ->first();


        return view('product.detail',compact('product','averageEvaluation'));
        
    }
}