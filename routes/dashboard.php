<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\Dashboardcontroller;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth'] , 
    'as' => 'dashboard.' ,
    'prefix' => 'dashboard'  
], function () {
    Route::get('/', [Dashboardcontroller::class, 'index'])
        ->name('dashboard');

    Route::resource('/categories', CategoriesController::class);
});
// Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function() {
// });