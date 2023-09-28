<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;

class RegisteredProductController extends Controller
{
    /**
     * 商品登録画面を表示する
     */
    public function productRegister(Request $request)
    {

        $categories=Product_category::all();
        $subcategories=Product_subcategory::all();
        return view('product.register',compact('categories','subcategories'));
        
    }
    /**
     * サブカテゴリを取得
     */
    public function getSub($key)
    {
        $subcategories=Product_subcategory::where('product_category_id',$key)->get();
        return response()->json($subcategories);
    }
    /**
     * 画像ファイルをproductImagesディレクトリに画像を保存
     */
    public function upload(Request $request)
    {

        $request->validate([
            'image_1'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'image_2'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'image_3'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'image_4'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        $paths=[];

        // productImagesディレクトリに画像を保存、パスの取得
        if($request->hasFile('image_1') ){
            $paths['path_1']=$request->file('image_1')->store('productImages','public');
        }elseif($request->session()->has('uploaded_paths.path_1')){
            $paths['path_1']=$request->session()->get('uploaded_paths.path_1');
        }

        if($request->hasFile('image_2')){
            $paths['path_2']=$request->file('image_2')->store('productImages','public');
        }elseif($request->session()->has('uploaded_paths.path_2')){
            $paths['path_2']=$request->session()->get('uploaded_paths.path_2');
        }

        if($request->hasFile('image_3')){
            $paths['path_3']=$request->file('image_3')->store('productImages','public');
        }elseif($request->session()->has('uploaded_paths.path_3')){
            $paths['path_3']=$request->session()->get('uploaded_paths.path_3');
        }

        if($request->hasFile('image_4')){
            $paths['path_4']=$request->file('image_4')->store('productImages','public');
        }elseif($request->session()->has('uploaded_paths.path_4')){
            $paths['path_4']=$request->session()->get('uploaded_paths.path_4');
        }

        \Log::info($paths);
    
        // セッションに入れる
        $request->session()->put('uploaded_paths',$paths);

        // パスを返す
        return response()->json($paths);
        
    }
    /**
     * データを受け渡す(バリデーション)
     */
    public function postProduct(Request $request)
    {
        
        $input = $request->all();

        $request->validate([
            'name'=>'required|max:100',
            'product_category_id'=>'required|numeric|exists:product_categories,id',
            'product_subcategory_id'=>'required|exists:product_subcategories,id',
            'product_content'=>'required|max:500',
        ]);

       

        // セッションに入れる
        $request->session()->put('register_input',$input);
        return redirect()->route('productConfirm');
        
    }
    /**
     * 確認画面を表示する
     */
    public function productConfirm(Request $request)
    {
        $input=$request->session()->get('register_input');

        // カテゴリとサブカテゴリの名前を取得
        $categoryName=Product_category::find($input['product_category_id'])->name;
        $subcategoryName=Product_subcategory::find($input['product_subcategory_id'])->name;

        // カテゴリとサブカテゴリの名前をinputに入れる
        $input['category_name']=$categoryName;
        $input['subcategory_name']=$subcategoryName;

        return view('product.confirm',compact('input'));
    }
    /**
     * 登録処理
     */
    public function exeProduct(Request $request)
    {
        // セッションから取り出す
        $paths=$request->session()->get('uploaded_paths',[]);
        $input=$request->session()->get('register_input');

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('productRegister')
        ->withInput($input);
        }


        // データベースに登録の処理
        $product=new Product();
        $product->member_id=auth()->id();
        $product->product_category_id=$input['product_category_id'];
        $product->product_subcategory_id=$input['product_subcategory_id'];
        $product->name=$input['name'];
        if(isset($paths['path_1'])){$product->image_1=$paths['path_1'];}
        if(isset($paths['path_2'])){$product->image_2=$paths['path_2'];}
        if(isset($paths['path_3'])){$product->image_3=$paths['path_3'];}
        if(isset($paths['path_4'])){$product->image_4=$paths['path_4'];}
        $product->product_content=$input['product_content'];
        $product->save();

        // セッションクリア
        $request->session()->forget('uploaded_paths');
       
        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('topLogin');
    }
    
}
