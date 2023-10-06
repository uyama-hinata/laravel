<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RegisterThanksController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisteredProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\RegisterReviewController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ChangeUserinfoController;
use App\Http\Controllers\ChangeReviewController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    
    // 会員登録画面を表示
    Route::get('register', [RegisteredUserController::class, 'userRegister'])->name('userRegister');
    // データを受け渡す
    Route::post('register', [RegisteredUserController::class, 'postData'])->name('postData');
    // 確認画面を表示
    Route::get('confirm', [RegisteredUserController::class, 'confirm'])->name('confirm');
    // 登録・メール送信
    Route::post('confirm', [RegisteredUserController::class, 'exeRegist'])->name('exeRegist');

    //パスワード再設定画面を表示する
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');   
    //パスワード再設定処理
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

    //メール入力画面を表示する
    Route::get('passwordMail', [PasswordResetLinkController::class, 'passwordMail'])->name('passwordMail');
    //メール送信処理
    Route::post('passwordMail', [PasswordResetLinkController::class, 'sendMail'])->name('sendMail');
    //メール送信完了画面を表示する
    Route::get('sentMail', [PasswordResetLinkController::class, 'sentMail'])->name('sentMail');

    //トップ画面（ログアウト時）を表示
    Route::get('topLogout', [TopController::class, 'topLogout'])->name('topLogout');
                
    //ログイン画面を表示
    Route::get('Login', [LoginController::class, 'Login'])->name('Login');
    //ログイン処理
    Route::post('Login', [LoginController::class, 'postLogin'])->name('postLogin');

    

});

Route::middleware('auth')->group(function () {

    
    //トップ画面（ログイン時）を表示
    Route::get('topLogin', [TopController::class, 'topLogin'])->name('topLogin');
    // ログアウト処理
    Route::post('topLogin', [LogoutController::class, 'destroy'])->name('logout');

    // 完了画面を表示・メール送信
    Route::get('thanks', [RegisterThanksController::class, 'thanks'])->name('thanks');

    // 商品登録画面を表示
    Route::get('product-register', [RegisteredProductController::class, 'productRegister'])->name('productRegister');
    // サブカテゴリを取得
    Route::get('product-register/{key}',[RegisteredProductController::class, 'getSub'])->name('getSub');
    // 画像ファイルを保存、パスの取得
    Route::post('upload',[RegisteredProductController::class, 'upload'])->name('upload');
    // データを受け渡す
    Route::post('product-register', [RegisteredProductController::class, 'postProduct'])->name('postProduct');
    // 確認画面を表示
    Route::get('product-confirm', [RegisteredProductController::class, 'productConfirm'])->name('productConfirm');
    // 登録
    Route::post('product-confirm', [RegisteredProductController::class, 'exeProduct'])->name('exeProduct');

    // レビュー登録画面を表示
    Route::get('review-register/{id}',[RegisterReviewController::class,'reviewRegister'])->name('reviewRegister');
    // データを受け渡す
    Route::post('review-register', [RegisterReviewController::class, 'postReview'])->name('postReview');
    // 確認画面を表示
    Route::get('review-confirm/{id}', [RegisterReviewController::class, 'reviewConfirm'])->name('reviewConfirm');
    // 登録
    Route::post('review-confirm', [RegisterReviewController::class, 'exeReview'])->name('exeReview');
    // 完了画面を表示
    Route::get('review-thanks', [RegisterReviewController::class, 'thanksReview'])->name('thanksReview');

    // マイページを表示
    Route::get('mypage',[MypageController::class,'mypage'])->name('mypage');
    // 退会ページを表示
    Route::get('delete',[MypageController::class,'delete'])->name('delete');
    // 退会処理
    Route::post('delete',[MypageController::class,'exeDelete'])->name('exeDelete');

    // 会員情報変更画面を表示
    Route::get('change-info',[ChangeUserinfoController::class,'changeInfo'])->name('changeInfo');
    // データを受け渡す
    Route::post('change-info',[ChangeUserinfoController::class,'postInfo'])->name('postInfo');
    // 確認画面を表示
    Route::get('info-confirm',[ChangeUserinfoController::class,'infoConfirm'])->name('infoConfirm');
    // 変更処理
    Route::post('info-confirm',[ChangeUserinfoController::class,'exeInfo'])->name('exeInfo');

    // パスワード変更画面を表示
    Route::get('change-pass',[ChangeUserinfoController::class,'changePass'])->name('changePass');
    // 変更処理
    Route::post('change-pass',[ChangeUserinfoController::class,'exeChangePass'])->name('exeChangePass');

    // メールアドレス変更画面を表示
    Route::get('change-email',[ChangeUserinfoController::class,'changeEmail'])->name('changeEmail');
    // 認証メール送信（バリデーション）
    Route::post('change-email', [ChangeUserinfoController::class, 'sendChangeEmail'])->name('sendChangeEmail');
    // 認証コード入力画面を表示
    Route::get('check-code', [ChangeUserinfoController::class, 'checkCode'])->name('checkCode');
    // メールアドレス変更の処理
    Route::post('check-code', [ChangeUserinfoController::class, 'exeChangeEmail'])->name('exeChangeEmail');

    // 商品レビュー管理画面を表示
    Route::get('review-admin',[ChangeReviewController::class,'reviewAdmin'])->name('reviewAdmin');
    // 商品レビュー編集画面を表示
    Route::get('review-edit/{id}',[ChangeReviewController::class,'reviewEdit'])->name('reviewEdit');
    // データを受け渡す
    Route::post('review-edit',[ChangeReviewController::class,'postEdit'])->name('postEdit');
    // 確認画面を表示
    Route::get('review-edit-confirm',[ChangeReviewController::class,'reviewEditConfirm'])->name('reviewEditConfirm');
    // 編集処理
    Route::post('review-edit-confirm',[ChangeReviewController::class,'exeEdit'])->name('exeEdit');
    // 商品レビュー削除確認画面を表示
    Route::get('review-delete/{id}',[ChangeReviewController::class,'reviewDelete'])->name('reviewDelete');
    // 削除処理
    Route::post('review-delete/{id}',[ChangeReviewController::class,'exeReviewDelete'])->name('exeReviewDelete');      
});

// 商品一覧を表示
Route::get('product-list',[ProductListController::class,'productList'])->name('productList');
// サブカテゴリを取得
Route::get('product-register/{key}',[ProductListController::class, 'getSub'])->name('getSub');

// 商品詳細を表示
Route::get('product-detail/{id}',[ProductDetailController::class,'productDetail'])->name('productDetail');

// レビュー一覧を表示
Route::get('product-review-list',[RegisterReviewController::class,'reviewList'])->name('reviewList');
