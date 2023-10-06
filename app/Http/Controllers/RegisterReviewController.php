<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Review;

class RegisterReviewController extends Controller
{
    /**
     * 登録画面を表示する
     */
    public function reviewRegister($id,Request $request)
    {
        $product = Product::find($id);

        // idが空の時はリストへ
        if(is_null($product)){
            return redirect('productList');
        }

        $averageEvaluation = Review::where('product_id',$id)
        ->selectRaw('FLOOR(AVG(evaluation)) as evaluations')
        ->first();

        // セッションに画像と名前をいれる
        $request->session()->put('product_name',$product->name);
        $request->session()->put('product_id',$product->id);
        $request->session()->put('product_review',$averageEvaluation->evaluations);
        $request->session()->put('product_image_1',$product->image_1);
        $request->session()->put('product_image_2',$product->image_2);
        $request->session()->put('product_image_3',$product->image_3);
        $request->session()->put('product_image_4',$product->image_4);

        return view('review.register',compact('id','product','averageEvaluation'));
        
    }
    /**
     * データを受け渡す（バリデーション）
     */
    public function postReview(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'evaluation'=>'required|in:1,2,3,4,5',
            'comment'=>'required|max:500',
        ]);

        // セッションに入れる
        $request->session()->put('register_input',$input);
        // セッションから出す
        $product_id=$request->session()->get('product_id');
        return redirect()->route('reviewConfirm',['id'=>$product_id]);
        
    }
    /**
     * 確認画面を表示
     */
    public function reviewConfirm(Request $request , $id)
    {
        // セッションから出す
        $input=$request->session()->get('register_input');
        $product_id=$request->session()->get('product_id');


        // セッションに入れる
        $product_id=$request->session()->get('product_id');

        

        return view('review.confirm',compact('input','product_id'));
        
    }
    /**
     * 登録処理
     */
    public function exeReview(Request $request)
    {
       $input=$request->all();
       // セッションから出す
       $product_id=$request->session()->get('product_id');

       // 戻るボタン処理
       if($request->has('btn_back')){
        return redirect()->route('reviewRegister',['id'=>session('product_id')])
        ->withInput($input);
        }

       // データベースに登録の処理
       $review=new Review();
       $review->member_id=auth()->id();
       $review->product_id=$product_id;
       $review->evaluation=$input['evaluation'];
       $review->comment=$input['comment'];
       $review->save();

        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('thanksReview');
    }
    /**
     * 完了画面を表示
     */
    public function thanksReview()
    {
       
        return view('review.thanks');
    }
    /**
     * レビュー一覧画面を表示
     */
    public function reviewList()
    {
        $reviews = Review::where('product_id',session('product_id'))->paginate(5);

        return view('review.list',compact('reviews'));
    }
}