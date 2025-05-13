<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\ClusterController;
use App\Http\Controllers\Api\v1\UnitController;
use App\Http\Controllers\Api\v1\UserController;
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
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

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