<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserRoleController;
use App\Http\Controllers\Web\VillageController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginAction'])->name('login-action');
Route::middleware(['auth'])->prefix('application')->name('application.')->group(function() {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
    });

    Route::prefix('role')->name('role.')->group(function() {
        Route::get('/', [UserRoleController::class, 'index'])->name('index');
        Route::get('create', [UserRoleController::class, 'create'])->name('create');
        Route::post('store', [UserRoleController::class,'store'])->name('store');
    });

    Route::prefix('province')->name('province.')->group(function() {
        Route::get('/', [ProvinceController::class, 'index'])->name('index');
        Route::get('create', [ProvinceController::class, 'create'])->name('create');
        Route::post('store', [ProvinceController::class,'store'])->name('store');
        Route::get('{id}', [ProvinceController::class, 'show'])->name('show');
        Route::get('update/{id}', [ProvinceController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [ProvinceController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('city')->name('city.')->group(function() {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::get('create', [CityController::class, 'create'])->name('create');
        Route::post('store', [CityController::class,'store'])->name('store');
        Route::get('{id}', [CityController::class, 'show'])->name('show');
        Route::get('update/{id}', [CityController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [CityController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('district')->name('district.')->group(function() {
        Route::get('/', [DistrictController::class, 'index'])->name('index');
        Route::get('create', [DistrictController::class, 'create'])->name('create');
        Route::post('store', [DistrictController::class,'store'])->name('store');
        Route::get('{id}', [DistrictController::class, 'show'])->name('show');
        Route::get('update/{id}', [DistrictController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [DistrictController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('village')->name('village.')->group(function() {
        Route::get('/', [VillageController::class, 'index'])->name('index');
        Route::get('create', [VillageController::class, 'create'])->name('create');
        Route::post('store', [VillageController::class,'store'])->name('store');
        Route::get('{id}', [VillageController::class, 'show'])->name('show');
        Route::get('update/{id}', [VillageController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [VillageController::class, 'destroy'])->name('destroy');
    });
});
