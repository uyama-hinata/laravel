<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use Illuminate\Http\Request;
use App\Rules\AtLeastOneFieldRequired;



class CategoryRegisterController extends Controller
{
    /**
     * 登録画面を表示
     */
    public function registerCategory(Request $request)
    {
        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','register');
        return view('admin.RegisterEditerCategory');
    }
     /**
     * データを受け渡す(バリデーション)
     */
    public function adminPostCategory(Request $request)
    {
        $request->validate([
            'category'=>'required|max:20',
            'subcategories'=>'required_without_all:subcategory1,subcategory2,subcategory3,subcategory4,subcategory5,subcategory6,subcategory7,subcategory8,subcategory9,subcategory10',
            'subcategory1'=>'max:20',
            'subcategory2'=>'max:20',
            'subcategory3'=>'max:20',
            'subcategory4'=>'max:20',
            'subcategory5'=>'max:20',
            'subcategory6'=>'max:20',
            'subcategory7'=>'max:20',
            'subcategory8'=>'max:20',
            'subcategory9'=>'max:20',
            'subcategory10'=>'max:20',
        ]);
        
        $input=$request->all();
        $request->session()->put('register_input',$input);
        return redirect()->route('adminCategoryConfirm');
    }
    /**
     * 確認画面を表示
     */
    public function adminCategoryConfirm(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');

        return view('admin.CategoryConfirm',['input'=>$input]);
    }
    /**
     * 登録する
     */
    public function exeCategoryRegister(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');
        

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('registerCategory')
        ->withInput($input);
        }
        if($request->has('btn_Back')){
            return redirect()->route('adminEditerCategory',['id'=>$input['id']])
            ->withInput($input);
        }
    
        if(session('previous_page')=='register'){
            // データベースに登録の処理
            $category=new Product_category();
        }
        elseif(session('previous_page')=='editer'){
            // データベースに上書きの処理
            $category=Product_category::find($input['id']); 

            // 既存のサブカテゴリを全て削除
            foreach($category->product_subcategories as $subcategory){
                $subcategory->delete();
            }
        }

        // 共通の処理
        $category->name=$input['category'];
        $category->save();

        // サブカテゴリの整形
        $subCategoriesInput=[];
        for ($i=1;$i<=10;$i++){
            if(!empty($input['subcategory'.$i])){
                $subCategoriesInput[]=$input['subcategory'.$i];
            }
        }

        // サブカテゴリを保存
        foreach($subCategoriesInput as $subCategoryName){
            $subcategory=new Product_subcategory();
            $subcategory->name=$subCategoryName;
            $subcategory->product_category_id=$category->id;
            $subcategory->save();
        }
        
        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('categoryList');
    }
    /**
     * 編集画面を表示
     */
    public function adminEditerCategory($id,Request $request)
    {
        $category=Product_category::find($id);
        $subcategories=$category->product_subcategories;

        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','editer');

        return view('admin.RegisterEditerCategory', compact('category','subcategories'));
    }
    
}