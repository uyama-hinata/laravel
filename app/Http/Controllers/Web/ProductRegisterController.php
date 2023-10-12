<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use Illuminate\Http\Request;


class ProductRegisterController extends Controller
{
    /**
     * 登録画面を表示
     */
    public function adminRegisterProduct(Request $request)
    {
        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','register');

        $categories=Product_category::all();
        $subcategories=Product_subcategory::all();
        $users=User::all();

        return view('admin.RegisterEditerProduct',compact('users','categories','subcategories'));
    }
    /**
     * サブカテゴリを取得
     */
    public function adminGetSub($key)
    {
        $subcategories=Product_subcategory::where('product_category_id',$key)->get();
        return response()->json($subcategories);
    }
    /**
     * 画像ファイルをproductImagesディレクトリに画像を保存
    */
    public function adminUpload(Request $request)
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
    
        // セッションに入れる
        $request->session()->put('uploaded_paths',$paths);

        // パスを返す
        return response()->json($paths);
        
    }
     /**
     * データを受け渡す(バリデーション)
     */
    public function adminPostProduct(Request $request)
    {
        $request->validate([
            'product_name'=>'required|max:100',
            'product_category_id'=>'required|numeric|exists:product_categories,id',
            'product_subcategory_id'=>'required|exists:product_subcategories,id',
            'product_content'=>'required|max:500',
        ]);
        
        $input=$request->all();
        $request->session()->put('register_input',$input);
        // dd($request->session()->get('register_input')); // 追加
        return redirect()->route('adminProductConfirm');
    }
    /**
     * 確認画面を表示
     */
    public function adminProductConfirm(Request $request)
    {
        dd($request->session()->all()); 

        // セッションから取り出す
        $input=$request->session()->get('register_input');

        // 会員名を取得
        $userName=User::find($input['user_id'])->name;

        // カテゴリとサブカテゴリの名前を取得
        $categoryName=Product_category::find($input['product_category_id'])->name;
        $subcategoryName=Product_subcategory::find($input['product_subcategory_id'])->name;

        // 会員とカテゴリとサブカテゴリの名前をinputに入れる
        $input['user_name']=$userName;
        $input['category_name']=$categoryName;
        $input['subcategory_name']=$subcategoryName;

        return view('admin.ProductConfirm',['input'=>$input]);
    }
    /**
     * 登録する
     */
    public function exeProductRegister(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('register_input');
        $paths=$request->session()->get('uploaded_paths',[]);

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('adminRegisterProduct')
        ->withInput($input);
        }
        if($request->has('btn_Back')){
            return redirect()->route('adminEditerProduct',['id'=>$input['id']])
            ->withInput($input);
        }
    
        if(session('previous_page')=='register'){
            // データベースに登録の処理
            $product=new Product();
        }
        elseif(session('previous_page')=='editer'){
            // データベースに上書きの処理
            $product=Product::find($input['id']); 
        }

        // データベースに登録の処理
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
        
        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('adminProductList');
    }
    /**
     * 編集画面を表示
     */
    public function adminEditerProduct($id,Request $request)
    {
        $product=Product::with(['product_category','product_subcategory','user'])->find($id);
        $users=User::all();
        $categories=Product_category::all();
        $subcategories=Product_subcategory::all();

        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','editer');

        return view('admin.RegisterEditerProduct',compact('product','users','categories','subcategories'));
    }
}