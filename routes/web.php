<?php

use App\Http\Controllers\Web\AdministersTopController;
use App\Http\Controllers\Web\UserListController;
use App\Http\Controllers\Web\UserRegisterController;
use App\Http\Controllers\Web\CategoryListController;
use App\Http\Controllers\Web\CategoryRegisterController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// 管理画面関連はこっち

Route::middleware('guest')->group(function () {
    // ログイン画面を表示
    Route::get('admin-login', [AdministersTopController::class, 'adminLogin'])->name('adminLogin');
    // ログイン処理
    Route::post('admin-login',[AdministersTopController::class, 'exeAdminLogin'])->name('exeAdminLogin');
});

Route::middleware('admin.auth')->group(function () {
    // トップ画面を表示
    Route::get('admin-top', [AdministersTopController::class, 'adminTop'])->name('adminTop');
    // ログアウト処理
    Route::post('admin-top', [AdministersTopController::class, 'adminLogout'])->name('adminLogout');

    // 会員一覧を表示
    Route::get('admin-userList', [UserListController::class, 'userList'])->name('userList');
    // 商品カテゴリ一覧を表示
    Route::get('admin-categoryList', [CategoryListController::class, 'categoryList'])->name('categoryList');

    // 会員登録画面を表示
    Route::get('admin-registerUser', [UserRegisterController::class, 'adminRegisterUser'])->name('adminRegisterUser');
    // データを受け渡す
    Route::post('admin-registerUser', [UserRegisterController::class, 'adminPostUser'])->name('adminPostUser');
    // 確認画面を表示
    Route::get('admin-registerUser/confirm', [UserRegisterController::class, 'adminUserConfirm'])->name('adminUserConfirm');
    // 登録処理
    Route::post('admin-registerUser/confirm',[UserRegisterController::class, 'exeUserRegister'])->name('exeUserRegister');
    // 編集画面を表示
    Route::get('admin-editerUser/{id}', [UserRegisterController::class, 'adminEditerUser'])->name('adminEditerUser');
    // データを受け渡す
    Route::post('admin-editerUser/{id}', [UserRegisterController::class, 'adminPostEditer'])->name('adminPostEditer');
    // 詳細画面を表示
    Route::get('admin-detailUser/{id}', [UserRegisterController::class, 'adminDetailUser'])->name('adminDetailUser');
    // 削除処理
    Route::post('admin-detailUser/{id}',[UserRegisterController::class, 'exeDeleteUser'])->name('exeDeleteUser');

    // カテゴリ登録画面を表示
    Route::get('admin-registerCategory', [CategoryRegisterController::class, 'registerCategory'])->name('registerCategory');
    // データを受け渡す
    Route::post('admin-registerCategory', [CategoryRegisterController::class, 'adminPostCategory'])->name('adminPostCategory');
    // 確認画面を表示
    Route::get('admin-registerCategory/confirm', [CategoryRegisterController::class, 'adminCategoryConfirm'])->name('adminCategoryConfirm');
    // 登録処理
    Route::post('admin-registerCategory/confirm',[CategoryRegisterController::class, 'exeCategoryRegister'])->name('exeCategoryRegister');
    // 編集画面を表示
    Route::get('admin-editerCategory/{id}', [CategoryRegisterController::class, 'adminEditerCategory'])->name('adminEditerCategory');
    // 詳細画面を表示
    Route::get('admin-detailCategory/{id}', [CategoryRegisterController::class, 'adminDetailCategory'])->name('adminDetailCategory');
    // 削除処理
    Route::post('admin-detailCategory/{id}',[CategoryRegisterController::class, 'exeDeleteCategory'])->name('exeDeleteCategory');
    
});

