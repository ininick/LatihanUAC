<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Authentication
Route::get('/login/{lang?}', [AuthController::class,'loginView'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('loginPost');
Route::get('/register/{lang?}', [AuthController::class,'registerView'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('registerPost');
Route::post('logout', [AuthController::class,'logout'])->name('logout');

//Features
Route::get('/dashboard', [AppController::class,'index'])->name('index');
Route::get('/profile', [AppController::class,'profileView'])->name('profile');
Route::post('/dashboard/payment', [AppController::class,'payment'])->name('payment');
Route::post('/dashboard/balance', [AppController::class,'overpaid'])->name('overpaid.balance');
Route::post('/dashboard/continue', [AppController::class,'dashboard'])->name('overpaid.continue');