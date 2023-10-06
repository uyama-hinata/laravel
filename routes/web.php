<?php

use App\Http\Controllers\Web\AdministersTopController;
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

});

