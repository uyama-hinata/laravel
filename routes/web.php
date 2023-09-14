<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 会員登録画面を表示
Route::get('/regist', [MemberController::class, 'memberRegist'])->name('memberRegist');
// データを受け渡す
Route::post('/regist', [MemberController::class, 'postData'])->name('postData');
// 確認画面を表示
Route::get('/confirm', [MemberController::class, 'confirm'])->name('confirm');
// 登録
Route::post('/confirm', [MemberController::class, 'exeRegist'])->name('exeRegist');
// 完了画面を表示・メール送信
Route::get('/thanks', [MemberController::class, 'thanks'])->name('thanks');


