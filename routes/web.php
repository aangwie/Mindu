<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UpdateSettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tes');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/tes', [StudentController::class, 'showTest'])->name('tes');
    Route::post('/tes/simpan', [StudentController::class, 'submitAnswer'])->name('test.submit');
    Route::put('/profil/update', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::get('/hasil/{result}', [StudentController::class, 'showResult'])->name('student.result');
    Route::get('/unduh-hasil/{result}', [TestResultController::class, 'download'])->name('download-result');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Questions CRUD
    Route::resource('questions', QuestionController::class);

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Results Management
    Route::get('/results', [ResultController::class, 'index'])->name('results.index');
    Route::delete('/results/{result}', [ResultController::class, 'destroy'])->name('results.destroy');

    // Settings
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Update Settings
    Route::get('/update-settings', [UpdateSettingsController::class, 'index'])->name('update-settings.index');
    Route::post('/update-settings/token', [UpdateSettingsController::class, 'updateToken'])->name('update-settings.token');
    Route::post('/update-settings/clear-cache', [UpdateSettingsController::class, 'clearCache'])->name('update-settings.clear-cache');
    Route::post('/update-settings/clear-config', [UpdateSettingsController::class, 'clearConfig'])->name('update-settings.clear-config');
    Route::post('/update-settings/run', [UpdateSettingsController::class, 'runUpdate'])->name('update-settings.run');
});
