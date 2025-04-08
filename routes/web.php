<?php

use App\Http\Controllers\ClusterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $testCourse = Course::find(100);
    $randomCourses = Course::where('id', '!=', 100)->inRandomOrder()->limit(8)->get();
    
    $courses = $testCourse ? $randomCourses->prepend($testCourse) : $randomCourses;

    return view('dashboard', compact('courses'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(UserController::class)->middleware(['auth', 'verified', 'role:Super Admin| Admin'])->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/create', 'create')->name('users.create');
    Route::post('/users', 'store')->name('users.store');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::get('/users/{user}/edit', 'edit')->name('users.edit');
    Route::match(['put', 'patch'], '/users/{user}', 'update')->name('users.update');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
});

Route::controller(RoleController::class)->middleware(['auth', 'verified', 'role:Super Admin'])->group(function () {
    Route::get('/roles', 'index')->name('roles.index');
    Route::get('/roles/create', 'create')->name('roles.create');
    Route::post('/roles', 'store')->name('roles.store');
    Route::get('/roles/{role}', 'show')->name('roles.show');
    Route::get('/roles/{role}/edit', 'edit')->name('roles.edit');
    Route::match(['put', 'patch'], '/roles/{role}', 'update')->name('roles.update');
    Route::delete('/roles/{role}', 'destroy')->name('roles.destroy');
});

Route::controller(PackageController::class)->middleware(['auth', 'verified', 'role:Super Admin|Admin|Staff'])->group(function () {
    Route::get('/packages', 'index')->name('packages.index');
    Route::get('/packages/create', 'create')->name('packages.create');
    Route::post('/packages', 'store')->name('packages.store');
    Route::get('/packages/{package}', 'show')->name('packages.show');
    Route::get('/packages/{package}/edit', 'edit')->name('packages.edit');
    Route::match(['put', 'patch'], '/packages/{package}', 'update')->name('packages.update');
    Route::delete('/packages/{package}', 'destroy')->name('packages.destroy');
});

Route::controller(CourseController::class)->middleware(['auth', 'verified', 'role:Super Admin|Admin|Staff'])->group(function () {
    Route::get('/courses', 'index')->name('courses.index');
    Route::get('/courses/create', 'create')->name('courses.create');
    Route::post('/courses', 'store')->name('courses.store');
    Route::get('/courses/{course}', 'show')->name('courses.show');
    Route::get('/courses/{course}/edit', 'edit')->name('courses.edit');
    Route::match(['put', 'patch'], '/courses/{course}', 'update')->name('courses.update');
    Route::delete('/courses/{course}', 'destroy')->name('courses.destroy');
});

Route::controller(ClusterController::class)->middleware(['auth', 'verified', 'role:Super Admin|Admin|Staff'])->group(function () {
    Route::get('/clusters', 'index')->name('clusters.index');
    Route::get('/clusters/create', 'create')->name('clusters.create');
    Route::post('/clusters', 'store')->name('clusters.store');
    Route::get('/clusters/{cluster}', 'show')->name('clusters.show');
    Route::get('/clusters/{cluster}/edit', 'edit')->name('clusters.edit');
    Route::match(['put', 'patch'], '/clusters/{cluster}', 'update')->name('clusters.update');
    Route::delete('/clusters/{cluster}', 'destroy')->name('clusters.destroy');
});

Route::controller(UnitController::class)->middleware(['auth', 'verified', 'role:Super Admin|Admin|Staff'])->group(function () {
    Route::get('/units', 'index')->name('units.index');
    Route::get('/units/create', 'create')->name('units.create');
    Route::post('/units', 'store')->name('units.store');
    Route::get('/units/{unit}', 'show')->name('units.show');
    Route::get('/units/{unit}/edit', 'edit')->name('units.edit');
    Route::match(['put', 'patch'], '/units/{unit}', 'update')->name('units.update');
    Route::delete('/units/{unit}', 'destroy')->name('units.destroy');
});

require __DIR__ . '/auth.php';
