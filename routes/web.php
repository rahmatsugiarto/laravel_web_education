<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EducationalMaterialController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminMaterialController;

// Rute default mengarah ke halaman login atau /materials tergantung status login
Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'materials.index' : 'login');
});

// Autentikasi bawaan Laravel
Auth::routes(['register' => true]);

Route::middleware(['auth'])->group(function () {
    Route::get('/materials', [EducationalMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [EducationalMaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [EducationalMaterialController::class, 'store'])->name('materials.store');
});

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/materials', [AdminMaterialController::class, 'index'])->name('admin.materials.index');
    Route::post('/admin/materials/{id}/approve', [AdminMaterialController::class, 'approve'])->name('admin.materials.approve');
});
