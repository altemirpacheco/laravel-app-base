<?php

use App\Http\Controllers\FakerController;
use App\Http\Controllers\HelperArrayController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app', function () {
    $laravel = app();
    return ["version" => $laravel::VERSION];
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/location', function () {
        return view('pages.location');
    })->name('location');

    // Route::get('/helpers', function () {
    //     return view('pages.helpers');
    // })->name('helpers');
    Route::get('/helpers', [HelperArrayController::class, "index"])->name('helpers');

});

# Usando o FAker PHP
Route::prefix('faker')->group(function () { 
    Route::get('/usuario', [ FakerController::class, 'usuario'])->name('faker.usuario');
});


require __DIR__.'/auth.php';
