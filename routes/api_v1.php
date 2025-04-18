<?php
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\CourseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * API Version 1 Routes
 */

/**
 * Packages API Routes
 *  - Index, Show (no-Auth)
 *  - Update, Destroy (Auth required)
 */
Route::apiResource('packages', PackageController::class);

/**
 * Courses API Routes
 *  - Index, Show (no-Auth)
 *  - Update, Destroy (Auth required)
 */
Route::apiResource('courses', CourseController::class);