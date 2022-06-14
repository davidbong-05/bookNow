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

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/profile/{user:id}', [App\Http\Controllers\ProfilesController::class, 'show'])->name('profile.show');
        Route::get('/profile/{user:id}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->middleware('can:edit,user');
        Route::patch('/profile/{user:id}', [App\Http\Controllers\ProfilesController::class, 'update'])->middleware('can:edit,user');

        Route::get('/myBooking/{user:id}', [App\Http\Controllers\BookingsController::class, 'show'])->name('booking.show');
        Route::get('/facility/{facility:id}/book-form', [App\Http\Controllers\BookingsController::class, 'create'])->middleware('can:submit-booking,user')->name('booking.create');
        Route::get('/facility/{court_id}/book-slot', [App\Http\Controllers\BookingsController::class, 'slot']);
        Route::post('/facility/book', [App\Http\Controllers\BookingsController::class, 'store'])->name('booking.store');
        Route::get('/booking_submitted', [App\Http\Controllers\BookingsController::class, 'success'])->name('booking.success');

        Route::delete('/myBooking/{booking}', [App\Http\Controllers\BookingsController::class, 'destroy'])->name('booking.destroy');

        Route::post('/facility/{facility:id}/review', [App\Http\Controllers\ReviewsController::class, 'store'])->name('review.store');
    });
    // Route::middleware('admin')->group(function () {

    //     Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    // });
});