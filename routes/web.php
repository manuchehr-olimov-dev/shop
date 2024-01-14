<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/catalog.php';

Route::get('/', HomeController::class)
    ->name('home');






