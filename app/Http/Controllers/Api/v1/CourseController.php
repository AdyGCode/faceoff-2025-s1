<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CoreContent\StoreCourseRequest;
use App\Http\Requests\v1\CoreContent\UpdateCourseRequest;
use Illuminate\Http\JsonResponse;

/**
 * API V1 - CourseController
 */
class CourseController extends Controller
{
    /**
     * Display a listing of all the Courses.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $courses = Course::all();

        if ($courses) {
            return ApiResponse::success($courses, 'Found all Courses');
        }
        return ApiResponse::error($courses, 'No Courses Found');
    }

    /**
     * Store a newly created Course in storage.
     * 
     * @param \App\Http\Requests\v1\StoreCourseRequest $request
     * @return JsonResponse
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $course = Course::create($request->all());
        
        if ($course) {
            return ApiResponse::success($course, "Course Created", 201);
        }
        return ApiResponse::error($course, "Course Not Created", code: 404);
    }

    /**
     * Display the specified Course.
     * 
     * @return JsonResponse
     */
    public function show(Course $course): JsonResponse
    {
        $course = Course::findOrFail($course->id);

        if ($course) {
            return ApiResponse::success($course, 'Course Found');
        }
        return ApiResponse::error($course, 'Course Not Found', 404);
    }

    /**
     * Update the specified Course in storage.
     * 
     * @param \App\Http\Requests\v1\UpdateCourseRequest $request
     * @return JsonResponse
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course = Course::where('id', '=', $course->id)->get()->first();

        $course->update($request->all());

        if ($course) {
            return ApiResponse::success($course, 'Course Upadated', 200);
        }
        return ApiResponse::error($course, 'Course Not Updated', 500);
    }

    /**
     * Remove the specified Course from storage.
     */
    public function destroy(Course $course)
    {
        $course = Course::find($course->id);

        if ($course) {
            $course->delete();
            return ApiResponse::success($course,'Course Succesfully Deleted');
        }
        return ApiResponse::error($course,'Course Not Deleted');
    }
}
