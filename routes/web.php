<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Owner\CategoryController as OwnerCategoryController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\FoodController as OwnerFoodController;
use App\Http\Controllers\Owner\OrderController as OwnerOrderController;
use App\Http\Controllers\Owner\ReportController as OwnerReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Food Ordering & Delivery Management System
|--------------------------------------------------------------------------
*/

// --- Language Switching Route ---
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');

// --- Public & Customer Browsing Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/food/{id}', [HomeController::class, 'foodDetail'])->name('food.detail');

// --- Cart Routes (Session Based) ---
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
});

// --- Authentication Routes ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/demo-login/{role}', [AuthController::class, 'demoLogin'])->name('demo.login');

// --- Authenticated Customer Routes ---
Route::middleware(['auth'])->group(function () {
    // Checkout & Order Placement
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

    // Orders Tracking & History
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{orderNumber}', [OrderController::class, 'show'])->name('show');
        Route::get('/{orderNumber}/track-api', [OrderController::class, 'trackStatusApi'])->name('track.api');
        Route::post('/{orderNumber}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::post('/{orderNumber}/review', [OrderController::class, 'submitReview'])->name('review');
    });
});

// --- Authenticated Restaurant Owner Routes ---
Route::middleware(['auth', 'role.owner'])->prefix('owner')->name('owner.')->group(function () {
    // Dashboard & Metrics
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');

    // Orders Management & Status Updates
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OwnerOrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OwnerOrderController::class, 'show'])->name('show');
        Route::post('/{id}/status', [OwnerOrderController::class, 'updateStatus'])->name('status.update');
    });

    // Foods CRUD & Availability Toggle
    Route::prefix('foods')->name('foods.')->group(function () {
        Route::get('/', [OwnerFoodController::class, 'index'])->name('index');
        Route::get('/create', [OwnerFoodController::class, 'create'])->name('create');
        Route::post('/', [OwnerFoodController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [OwnerFoodController::class, 'edit'])->name('edit');
        Route::put('/{id}', [OwnerFoodController::class, 'update'])->name('update');
        Route::delete('/{id}', [OwnerFoodController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-availability', [OwnerFoodController::class, 'toggleAvailability'])->name('toggle');
    });

    // Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [OwnerCategoryController::class, 'index'])->name('index');
        Route::post('/', [OwnerCategoryController::class, 'store'])->name('store');
        Route::put('/{id}', [OwnerCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [OwnerCategoryController::class, 'destroy'])->name('destroy');
    });

    // Reports & Customer Roster
    Route::get('/reports', [OwnerReportController::class, 'index'])->name('reports.index');
});
