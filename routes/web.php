<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EducationalMaterialController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminMaterialController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Autentikasi Laravel
Auth::routes(['register' => true]); // Menonaktifkan registrasi

// Rute untuk halaman home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute materi edukasi
    Route::get('/materials', [EducationalMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [EducationalMaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [EducationalMaterialController::class, 'store'])->name('materials.store');

    // Rute komentar
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Rute untuk admin yang membutuhkan autentikasi dan role admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/materials', [AdminMaterialController::class, 'index'])->name('admin.materials.index');
    Route::post('/admin/materials/{id}/approve', [AdminMaterialController::class, 'approve'])->name('admin.materials.approve');
});


