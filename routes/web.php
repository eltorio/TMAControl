<?php

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

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


use App\Http\Controllers\TMAStateViewOnlyController;
Route::get('tmastateview', [TMAStateViewOnlyController::class,'show'])->name('tmastatepublic');
Route::get('tmastatesecuredmessage', [TMAStateViewOnlyController::class,'securedMessage']);
Route::get('checkmessage', [TMAStateViewOnlyController::class,'checkSecuredMessage']);

use App\Http\Controllers\TMAStateChangeController;
//Route::resource('tmastatechange', TMAStateChangeController::class)->middleware('auth');
Route::get('tmastatechange', [TMAStateChangeController::class,'show'])->middleware(['auth','has_role:setter'])->name('tmastatechange');
Route::post('tmastatechange', [TMAStateChangeController::class,'create'])->middleware(['auth','has_role:setter']);
Route::get('tmastatechange/list', [TMAStateChangeController::class,'index'])->middleware(['auth','has_role:setter'])->name('tmastateviewchanges');