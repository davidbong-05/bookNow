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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/facility/{facility:name}', [App\Http\Controllers\FacilitiesController::class, 'show'])->name('facility.show');

//UNIMAS Identity
Route::get('auth/unimas_identity', [App\Http\Controllers\SocialiteUNIMASIdentityController::class, 'redirectToUNIMASIdentity']);
Route::get('auth/unimas_identity/callback', [App\Http\Controllers\SocialiteUNIMASIdentityController::class, 'UNIMASIdentitySignIn']);

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user:id}', [App\Http\Controllers\ProfilesController::class, 'show'])->name('profile.show');
    Route::patch('/profile/{user:id}', [App\Http\Controllers\ProfilesController::class, 'update'])->middleware('can:edit,user');

    Route::get('/myBooking/{user:id}', [App\Http\Controllers\BookingsController::class, 'show'])->middleware('can:edit,user')->name('booking.show');
    Route::get('/facility/{facility:id}/book-form', [App\Http\Controllers\BookingsController::class, 'create'])->middleware('can:submit-booking,user')->name('booking.create');
    Route::post('/facility/book', [App\Http\Controllers\BookingsController::class, 'store'])->name('booking.store');

    Route::patch('/myBooking/{booking}', [App\Http\Controllers\BookingsController::class, 'update'])->name('booking.update');
    // Route::delete('/myBooking/{booking}', [App\Http\Controllers\BookingsController::class, 'destroy'])->name('booking.destroy');

    Route::post('/facility/{facility:id}/review', [App\Http\Controllers\ReviewsController::class, 'store'])->name('review.store');
    // Route::middleware('admin')->group(function () {

    //     Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    // });
});

Route::post('/enquiry-mail', [App\Http\Controllers\EnquiriesController::class, 'store']);