<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ParkingController;
use App\Http\Controllers\api\v1\Parking_placeController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\OwnerController;
use App\Http\Controllers\api\v1\VehicleController;
use App\Http\Controllers\api\v1\TicketController;


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



Route::apiResource('v1/users', UserController::class);

Route::post('/v1/login',[App\Http\Controllers\api\v1\AuthController::class,'login'])
->name('api.login');


Route::middleware(['auth:sanctum'])->group(function() {

    Route::apiResource('v1/parkings', ParkingController::class);
    Route::apiResource('v1/parking_places', Parking_placeController::class);
    Route::apiResource('v1/owners', OwnerController::class);
    Route::apiResource('v1/vehicles', VehicleController::class);
    Route::apiResource('v1/tickets', TicketController::class);

    Route::get('v1/parkings/{parking}', [ParkingController::class, 'statistics']);

    Route::post('v1/parkings/{parking}/tickets', [TicketController::class, 'store']);
    Route::put('v1/parkings/{parking}/tickets/{ticket}', [TicketController::class, 'update']);

    Route::get('v1/parkings/{parking}/parking_places', [Parking_placeController::class, 'index']);
    Route::post('v1/parkings/{parking}/parking_places', [Parking_placeController::class, 'store']);
    Route::get('api/v1/parkings/{parking}/parking_places?status=available', [Parking_placeController::class, 'available']);

    Route::post('/v1/logout', [App\Http\Controllers\api\v1\AuthController::class,'logout'])
    ->name('api.logout');
   });
   
