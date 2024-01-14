<?php

use App\Http\Controllers\Catalog\CatalogController;
use Illuminate\Support\Facades\Route;

Route::controller(CatalogController::class)->group(function (){

    Route::get('/catalog/{catalog:slug?}', 'page')
        ->name('catalog');
});
