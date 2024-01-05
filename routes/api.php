<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TraineeController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\EventController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// web.php or api.php

// Routes without authentication
// Route::get("trainee", [TraineeController::class, 'index'])->name('init');
// Route::get("trainee/{TNumber}", [TraineeController::class, 'show']);

// Routes requiring authentication
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('users/getUsers', [TraineeController::class, 'getUsers'])->name('users.getUsers');
// });

// Route::middleware(['web'])->group(function () {
//     Route::get('users/getUsers', [TraineeController::class, 'getUsers'])->name('users.getUsers');
//     Route::get("trainee", [TraineeController::class, 'index'])->name('init');
//     Route::get("trainee/{TNumber}", [TraineeController::class, 'show']);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("events", EventController::class);

