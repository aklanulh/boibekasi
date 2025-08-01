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
    
    // Temporary placeholder routes to prevent errors
    Route::get('/members', function() { return redirect()->route('admin.dashboard')->with('info', 'Member management coming soon!'); })->name('admin.members.index');
    Route::get('/members/create', function() { return redirect()->route('admin.dashboard'); })->name('admin.members.create');
    Route::get('/members/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.members.show');
    Route::get('/members/{id}/edit', function() { return redirect()->route('admin.dashboard'); })->name('admin.members.edit');
    Route::post('/members', function() { return redirect()->route('admin.dashboard'); })->name('admin.members.store');
    Route::put('/members/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.members.update');
    Route::delete('/members/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.members.destroy');
    
    Route::get('/merchandise', function() { return redirect()->route('admin.dashboard')->with('info', 'Merchandise management coming soon!'); })->name('admin.merchandise.index');
    Route::get('/merchandise/create', function() { return redirect()->route('admin.dashboard'); })->name('admin.merchandise.create');
    Route::get('/merchandise/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.merchandise.show');
    Route::get('/merchandise/{id}/edit', function() { return redirect()->route('admin.dashboard'); })->name('admin.merchandise.edit');
    Route::post('/merchandise', function() { return redirect()->route('admin.dashboard'); })->name('admin.merchandise.store');
    Route::put('/merchandise/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.merchandise.update');
    Route::delete('/merchandise/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.merchandise.destroy');
    
    Route::get('/events', function() { return redirect()->route('admin.dashboard')->with('info', 'Event management coming soon!'); })->name('admin.events.index');
    Route::get('/events/create', function() { return redirect()->route('admin.dashboard'); })->name('admin.events.create');
    Route::get('/events/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.events.show');
    Route::get('/events/{id}/edit', function() { return redirect()->route('admin.dashboard'); })->name('admin.events.edit');
    Route::post('/events', function() { return redirect()->route('admin.dashboard'); })->name('admin.events.store');
    Route::put('/events/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.events.update');
    Route::delete('/events/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.events.destroy');
    
    Route::get('/documentation', function() { return redirect()->route('admin.dashboard')->with('info', 'Documentation management coming soon!'); })->name('admin.documentation.index');
    Route::get('/documentation/create', function() { return redirect()->route('admin.dashboard'); })->name('admin.documentation.create');
    Route::get('/documentation/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.documentation.show');
    Route::get('/documentation/{id}/edit', function() { return redirect()->route('admin.dashboard'); })->name('admin.documentation.edit');
    Route::post('/documentation', function() { return redirect()->route('admin.dashboard'); })->name('admin.documentation.store');
    Route::put('/documentation/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.documentation.update');
    Route::delete('/documentation/{id}', function() { return redirect()->route('admin.dashboard'); })->name('admin.documentation.destroy');
});

// Default login route redirect
Route::get('/login', function() {
    return redirect()->route('admin.login');
})->name('login');


