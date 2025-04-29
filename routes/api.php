<?php

use App\ApiResponse;
use Illuminate\Support\Facades\Route;

/**
 * API Routes defined by version in separate files.
 * 
 * V1   routes/api_v1.php
 * 
 */

/**
 * Fallback to 404
 */
Route::fallback(function(){
    return ApiResponse::error(
    [], 
    'Page Not Found. If error persists, contact info@website.com', 
    404
    );
});
