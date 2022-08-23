<?php

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



require __DIR__.'/auth.php';
