<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class ReviewRegisterController extends Controller
{
    /**
     * 登録画面を表示
     */
    public function adminRegisterReview(Request $request)
    {
        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','register');
        $products=Product::all();
        $users=User::all();

        return view('admin.RegisterEditerReview',compact('products','users'));
    }
     /**
     * データを受け渡して確認画面を表示する(バリデーション)
     */
    public function adminPostReview(Request $request)
    {
        $request->validate([
            'product_id'=>'required|numeric|exists:products,id',
            'user_id'=>'required|numeric|exists:users,id',
            'evaluation'=>'required|regex:/^[1-5]$/',
            'comment'=>'required|max:500',
        ]);

        $input=$request->all();

        // 確認画面に対象商品情報を表示
        if(session('previous_page')=='register'){
            $id=$input['product_id'];
        }
        elseif(session('previous_page')=='editer'){
            // セッションから取り出す
            $id=$request->session()->get('product_id');
        }
        $product=Product::find($id);
        
        // 総合評価
        $averageEvaluation=intval($product->reviews->avg('evaluation'));
        
        
        // セッションに入れる
        $request->session()->put('admin_register_input',$input);

        return view('admin.ReviewConfirm',compact('input','product','averageEvaluation'));
    }
    /**
     * 登録する
     */
    public function exeReviewRegister(Request $request)
    {
        // セッションから取り出す
        $input=$request->session()->get('admin_register_input');

        // 戻るボタン処理
        if($request->has('btn_back')){
        return redirect()->route('adminRegisterReview')
        ->withInput($input);
        }
        if($request->has('btn_Back')){
            return redirect()->route('adminEditerReview',['id'=>$input['id']])
            ->withInput($input);
        }
    
        if(session('previous_page')=='register'){
            // データベースに登録の処理
            $review=new Review();
        }
        elseif(session('previous_page')=='editer'){
            // データベースに上書きの処理
            $review=Review::find($input['id']); 
        }

        // 共通の部分
        $review->member_id=$input['user_id'];
        $review->product_id=$input['product_id'];
        $review->evaluation=$input['evaluation'];
        $review->comment=$input['comment'];
        $review->save();
        
        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('adminReviewList');
    }
    /**
     * 編集画面を表示
     */
    public function adminEditerReview($id,Request $request)
    {
        $review=Review::find($id);
        $products=Product::all();
        $users=User::all();

        // セッションに現在の画面場所を保存
        $request->session()->put('previous_page','editer');

        // セッションに商品のIDを保存
        $request->session()->put('product_id',$review->product_id);

        return view('admin.RegisterEditerReview',compact('review','products','users'));
    }
    
}