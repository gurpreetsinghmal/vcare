<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('getUserRole',[ApiController::class,'getUserRole']);
Route::get('getAshaProfile',[ApiController::class,'getAshaProfile']);
Route::get('getAnmProfile',[ApiController::class,'getAnmProfile']);
Route::get('getGdmoProfile',[ApiController::class,'getGdmoProfile']);
Route::get('getvillagelist',[ApiController::class,'getvillagelist']);
Route::get('genotp',[ApiController::class,'getuserbymobile']);
Route::post('updatetoken',[ApiController::class,'updatetoken']);
Route::post('addpatient',[ApiController::class,'addpatient']);
Route::post('searchpatient',[ApiController::class,'searchpatient']);
Route::post('ashaupdatepatient',[ApiController::class,'ashaupdatepatient']);
Route::post('anmupdatepatient',[ApiController::class,'anmupdatepatient']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 