<?php

use App\Models\Announcements;
use App\Models\Courts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('announcements', function () {
    return Announcements::limit(10)->latest()->get();
});
Route::post('bookings/pending', function (Request $request) {
    return Courts::find($request->input('id'))->pending();
});
Route::post('bookings/booked', function (Request $request) {
    return Courts::find($request->input('id'))->booked();
});