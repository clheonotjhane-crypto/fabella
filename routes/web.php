<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Dashboard Route
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

// Users Table Route
Route::get('/users', [UserController::class, 'usersTable'])->name('users');
Route::post('/users', [UserController::class, 'addUser']);

// Product Routes (Second Module - CRUD)
Route::get('/products', [ProductController::class, 'productsTable'])->name('products');
Route::post('/products', [ProductController::class, 'addProduct']);
Route::post('/products/update/{id}', [ProductController::class, 'updateProduct']);
Route::post('/products/delete/{id}', [ProductController::class, 'deleteProduct']);

// Profile Route
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::post('/profile/update', [AuthController::class, 'updateProfile']);
Route::post('/profile/picture', [AuthController::class, 'updatePicture']);

// User Update and Delete Routes
Route::post('/users/update/{id}', [UserController::class, 'updateUser'])->name('users.update');
Route::post('/users/delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');