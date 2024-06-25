<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MusicTermsController;

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

Route::get('/', function () {
    return "Selamat datang di aplikasi Kamus Istilah";
});

// Auth
Route::middleware(['guest'])->group(function () {
    Route::get('/admin/register', [AuthController::class, 'register']);
    Route::post('/admin/register', [AuthController::class, 'store']);
    Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'authenticate']);
});
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Music Terms
Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/terms', [MusicTermsController::class, 'index']);
    Route::get('/admin/terms/create', [MusicTermsController::class, 'create']);
    Route::post('/admin/terms', [MusicTermsController::class, 'store']);
    Route::get('/admin/terms/{term}/edit', [MusicTermsController::class, 'edit']);
    Route::post('/admin/terms/{term}', [MusicTermsController::class, 'update']);
    Route::delete('/admin/terms/{term}', [MusicTermsController::class, 'destroy']);
});

// Searching Algorithm API
Route::get('/music-list', [MusicTermsController::class, 'indexAPI']);
Route::get('/music/show/{id}', [MusicTermsController::class, 'showAPI']);
Route::get('/music', [MusicTermsController::class, 'searchAPI']);
