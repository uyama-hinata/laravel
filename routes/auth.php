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

    // 完了画面を表示
    Route::get('thanks', [RegisterThanksController::class, 'thanks'])->name('thanks');
    
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
                 
});

// 商品一覧を表示
Route::get('product-list',[ProductListController::class,'productList'])->name('productList');
// サブカテゴリを取得
Route::get('product-register/{key}',[ProductListController::class, 'getSub'])->name('getSub');

// 商品詳細を表示
Route::get('product-detail/{id}',[ProductDetailController::class,'productDetail'])->name('productDetail');

// レビュー一覧を表示
Route::get('product-review-list',[RegisterReviewController::class,'reviewList'])->name('reviewList');
