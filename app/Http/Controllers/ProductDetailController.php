<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use App\Models\Product;

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

        return view('product.detail',compact('id','product'));
        
    }
}