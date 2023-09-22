<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RegisterThanksController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\NewPasswordController;

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
require __DIR__ . '/auth.php';

// 会員登録画面を表示
Route::get('/register', [RegisteredUserController::class, 'userRegister'])->name('userRegister');
// データを受け渡す
Route::post('/register', [RegisteredUserController::class, 'postData'])->name('postData');
// 確認画面を表示
Route::get('/confirm', [RegisteredUserController::class, 'confirm'])->name('confirm');
// 登録
Route::post('/confirm', [RegisteredUserController::class, 'exeRegist'])->name('exeRegist');


// 完了画面を表示・メール送信
Route::get('/thanks', [RegisterThanksController::class, 'thanks'])->name('thanks');
// データを受け渡す
Route::post('/thanks', [RegisterThanksController::class, 'postThanks'])->name('postThanks');


//トップ画面（ログアウト時）を表示
Route::get('/topLogout', [TopController::class, 'topLogout'])->name('topLogout');
//トップ画面（ログイン時）を表示
Route::get('/topLogin', [TopController::class, 'topLogin'])->name('topLogin');


//ログイン画面を表示
Route::get('/Login', [LoginController::class, 'Login'])->name('Login');
//ログイン処理
Route::post('/Login', [LoginController::class, 'postLogin'])->name('postLogin');


//メール入力画面を表示する
Route::get('/passwordMail', [PasswordResetLinkController::class, 'passwordMail'])->name('passwordMail');
//メール送信処理
Route::post('/passwordMail', [PasswordResetLinkController::class, 'sendMail'])->name('sendMail');
//メール送信完了画面を表示する
Route::get('/sentMail', [PasswordResetLinkController::class, 'sentMail'])->name('sentMail');


// //パスワード再設定画面を表示する
// Route::get('/resetPass/{token}', [NewPasswordController::class, 'create'])->name('createe');
// //パスワード再設定処理
// Route::post('/resetPass', [NewPasswordController::class, 'store'])->name('newPass');
