<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\Http\Request;

class ChangeReviewController extends Controller
{
    /**
     * 商品レビュー管理画面を表示
     */
    public function reviewAdmin()
    {
       // 現在のユーザーIDを取得
       $userId=Auth::id();
       $reviews = Review::with('product')->where('member_id',$userId)->paginate(5);

       
        return view('mypage.reviewAdmin',compact('reviews'));
    }
    /**
     * 編集画面を表示
     */
    public function reviewEdit(Request $request,$id)
    {
        $review=Review::with('product')->findOrFail($id);

        // 初期値に元のレビュー内容をセット
        $first['evaluation']=$review->evaluation;
        $first['comment']=$review->comment;

        // 総合評価
        $averageEvaluation=Review::where('product_id',$review->product->id)
        ->selectRaw('FLOOR(AVG(evaluation)) as avg_evaluation')
        ->value('avg_evaluation');

        

        // セッションに画像、名前、商品ID、レビューIDをいれる
        $request->session()->put('product_name',$review->product->name);
        $request->session()->put('product_id',$review->product->id);
        $request->session()->put('product_review',$averageEvaluation);
        $request->session()->put('review_id',$id);
        $request->session()->put('product_image_1',$review->product->image_1);
        $request->session()->put('product_image_2',$review->product->image_2);
        $request->session()->put('product_image_3',$review->product->image_3);
        $request->session()->put('product_image_4',$review->product->image_4);

        return view('mypage.reviewEdit',compact('review','averageEvaluation','first'));
    }
    /**
     * データを受け渡す
     */
    public function postEdit(Request $request)
    {

        $input = $request->all();
        $request->validate([
            'evaluation'=>'required|in:1,2,3,4,5',
            'comment'=>'required|max:500',
        ]);

        // セッションに入れる
        $request->session()->put('Edit_input',$input);
        
        return redirect()->route('reviewEditConfirm');
        
    }
    /**
     * 確認画面を表示
     */
    public function reviewEditConfirm(Request $request)
    {
        //セッションから商品IDを出す
        $productId=$request->session()->get('product_id');

        $review=Review::with('product')->where('product_id',$productId)->first();

        // セッションから出す
        $input=$request->session()->get('Edit_input');
    
        return view('mypage.reviewEditConfirm',compact('input','review'));
        
    }
    /**
     * 登録処理
     */
    public function exeEdit(Request $request)
    {
        //セッションからレビューIDを出す
        $reviewId=$request->session()->get('review_id');
        $input = $request->all();

        // 戻るボタン処理（inputの値を引き継いで編集画面に戻る）
        if($request->has('btn_back')){
            return redirect()->route('reviewEdit',['id'=>$reviewId])
            ->withInput($input);
        }

        // レビューIDでレビューを検索
        $review= Review::find($reviewId);

        // データベースに上書きの処理
        $review->evaluation=$input['evaluation'];
        $review->comment=$input['comment'];
        $review->save();

        // 二重登録を防ぐ
        $request->session()->regenerateToken();

        return redirect()->route('reviewAdmin');
    }
    /**
     * 商品レビュー削除確認画面を表示
     */
    public function reviewDelete($id)
    {
        $review=Review::with('product')->findOrFail($id);

        $first['evaluation']=$review->evaluation;
        $first['comment']=$review->comment;

        $averageEvaluation=Review::where('product_id',$review->product->id)
        ->selectRaw('FLOOR(AVG(evaluation)) as avg_evaluation')
        ->value('avg_evaluation');

        return view('mypage.reviewDelete',compact('review','averageEvaluation','first'));
    }
    /**
     * 削除処理
     */
    public function exeReviewDelete($id)
    {
        $review=Review::find($id);
        $review->delete();
        
        return redirect()->route('reviewAdmin');
    }
}