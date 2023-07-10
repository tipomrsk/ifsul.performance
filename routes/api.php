<?php

use App\Http\Controllers\FleetController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-fleet-data', [FleetController::class, 'getFleetData']);

//get-user-fleets
Route::get('/get-user-fleets', [FleetController::class, 'getUserFleets']);

// get-fleet-location
Route::get('/get-user-fleet-location', [FleetController::class, 'getUserFleetLocation']);

Route::get('/get-user-fleet-location-better', [FleetController::class, 'getUserFleetLocationBetter']);


// get-client-data
Route::get('/get-client-data', [FleetController::class, 'getClientData']);