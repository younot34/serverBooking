<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    BuildingController,
    SpaceController,
    DeviceController,
    MediaController,
    BookingController,
    AuthController,
    UserController,
    HistoryController,
    PasswordResetController
};

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [PasswordResetController::class, 'reset']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::put('/users/{id}/password', [UserController::class, 'updatePassword'])->middleware('auth:sanctum');
Route::get('/history', [HistoryController::class, 'index']);
Route::apiResource('buildings', BuildingController::class);
Route::apiResource('spaces', SpaceController::class);
Route::apiResource('devices', DeviceController::class);
Route::post('/devices/register', [DeviceController::class, 'registerOrGet']);
Route::put('/devices/{room_name}/status', [DeviceController::class, 'updateByRoomName']);
Route::apiResource('media', MediaController::class);
Route::apiResource('bookings', BookingController::class);
Route::post('/bookings/{id}/end', [BookingController::class, 'endBooking']);
Route::get('bookings/room/{roomName}', [BookingController::class, 'getByRoom']);
