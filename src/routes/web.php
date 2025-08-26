<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;

//お問い合わせフォーム
Route::middleware('auth')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index'); // 入力ページ
    Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm'); // 確認ページ
    Route::get('/confirm', function () {
        return
            redirect()->route('contact.index');
    });
    Route::post('/send', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/thanks', [ContactController::class, 'thanks'])->name(
        'thanks'
    ); // サンクスページ
});


// 管理画面
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});


// 認証
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/dashboard', fn() =>
redirect('/'))->name('dashboard');
