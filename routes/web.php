<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\AdminController;

// Public routes - Coming Soon pages
Route::get('/', function() {
    return view('coming-soon', ['page' => 'Home']);
})->name('home');

Route::get('/members', function() {
    return view('coming-soon', ['page' => 'Member Aktif']);
})->name('members');

Route::get('/merchandise', function() {
    return view('coming-soon', ['page' => 'Merchandise']);
})->name('merchandise');

Route::get('/documentation', function() {
    return view('coming-soon', ['page' => 'Dokumentasi']);
})->name('documentation');

// Active routes
Route::get('/events', [EventController::class, 'index'])->name('events');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/tinker', [AdminController::class, 'tinker'])->name('admin.tinker');
    Route::post('/tinker/execute', [AdminController::class, 'executeTinker'])->name('admin.tinker.execute');
    Route::get('/database', [AdminController::class, 'databaseInfo'])->name('admin.database');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Default login route redirect
Route::get('/login', function() {
    return redirect()->route('admin.login');
})->name('login');

// Admin authentication routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
});

// Protected admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    Route::resource('members', App\Http\Controllers\Admin\MemberAdminController::class);
    Route::resource('merchandise', App\Http\Controllers\Admin\MerchandiseAdminController::class);
    Route::resource('events', App\Http\Controllers\Admin\EventAdminController::class);
    Route::resource('documentation', App\Http\Controllers\Admin\DocumentationAdminController::class);
});
