<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\ClusterController;
use App\Http\Controllers\Api\v1\UnitController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\PermissionController;
use App\Http\Controllers\Api\v1\ClassSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * API Version 1 Routes
 *
 * 'api.' added to prefix the nameing of API rotues,
 * as to not interfere with the Web routes.
 */


/**
 * Auth API Routes
 *  - Register, Login (no-Auth)
 *  - Login User detail, Logout (Auth required)
 */
Route::group(['prefix'=> 'auth'], function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  })->middleware('auth:sanctum');
  Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
Route::post('/login', [AuthController::class, 'login']);


/**
 * Users API Routes
 *  - Index, create, Show, Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
});


/**
 * Packages API Routes
 *  - Index, Show (no-Auth)
 *  - Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('packages', PackageController::class);
});

/**
 * Courses API Routes
 *  - Index, Show (no-Auth)
 *  - Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('courses', CourseController::class);
});

/**
 * Clusters API Routes
 *  - Index, Show (no-Auth)
 *  - Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('clusters', ClusterController::class);
});

/**
 * Units API Routes
 *  - Index, Show (no-Auth)
 *  - Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('units', UnitController::class);
});


/**
 * Roles API Routes
 *  - Index, Create, Show, Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');
});

/**
 * Permissions API Routes
 *  - Index, Create, Show, Update, Destroy (Auth required)
 */
Route::name("api.")->group(function(){
  Route::apiResource('permissions', PermissionController::class)->middleware('auth:sanctum');
});


/**
 * Class Sessions API Routes
 *  - Index, Show (no-Auth)
 *  - Store, Update, Destroy (Auth required)
 */
Route::name("api.")->group(function () {
    Route::get('class-sessions', [ClassSessionController::class, 'index']);
    Route::get('class-sessions/{classSession}', [ClassSessionController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('class-sessions', [ClassSessionController::class, 'store']);
        Route::put('class-sessions/{classSession}', [ClassSessionController::class, 'update']);
        Route::patch('class-sessions/{classSession}', [ClassSessionController::class, 'update']);
        Route::delete('class-sessions/{classSession}', [ClassSessionController::class, 'destroy']);
    });
});