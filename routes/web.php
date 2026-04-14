<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

// Halaman publik (user)
Route::get('/', [PublicController::class, 'dashboard'])->name('public.dashboard');
Route::get('/lokasi', [PublicController::class, 'locations'])->name('public.locations');
Route::get('/lokasi/{id}', [PublicController::class, 'locationDetail'])->name('public.location.detail');
Route::get('/profil-pengembang', [PublicController::class, 'developer'])->name('public.developer');