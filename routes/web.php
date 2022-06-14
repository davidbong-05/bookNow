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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//UNIMAS Identity
Route::get('auth/unimas_identity', [App\Http\Controllers\SocialiteUNIMASIdentityController::class, 'redirectToUNIMASIdentity']);
Route::get('auth/unimas_identity/callback', [App\Http\Controllers\SocialiteUNIMASIdentityController::class, 'UNIMASIdentitySignIn']);