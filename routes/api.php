<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;


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


# Get all resource patients
# method get
Route::get('/patients', [PatientController::class, 'index']);

# Add resource patients
# method post
Route::post('/patients', [PatientController::class, 'store']);

# Get detail patients
# Method show
Route::get('/patients/{id}', [PatientController::class, 'show']);

# Edit resource patients
# method put
Route::put('/patients/{id}', [PatientController::class, 'update']);

# Delete resouce patients
# method delete
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

# Delete resouce patients
# method delete
Route::get('/patients/search/{name}', [PatientController::class, 'search']);

# Delete resouce patients
# method delete
Route::get('/patients/status/positive', [PatientController::class, 'positive']);
# Delete resouce patients
# method delete
Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);

# Delete resouce patients
# method delete
Route::get('/patients/status/dead', [PatientController::class, 'dead']);

// Make route to register and login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
