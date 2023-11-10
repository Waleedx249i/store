<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/store/{vue_capture?}', function () {
    return view('store');
})->where('vue_capture', '[\/\w\.-]*')->name('store');

Auth::routes();
Route::get('/', function () {
    return route('store');
});
Route::get('/dashbord', [App\Http\Controllers\HomeController::class, 'index'])->name('dashbord');
