<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\ClassSession;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreClassSessionRequest;
use App\Http\Requests\v1\UpdateClassSessionRequest;
use Illuminate\Http\JsonResponse;

/**
 * API V1 - ClassSessionController
 */
class ClassSessionController extends Controller
{
    /**
     * GET /api/v1/class-sessions
     * Display a listing of all class sessions.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $sessions = ClassSession::with(['cluster', 'staff', 'students'])->get();

        if ($sessions->isNotEmpty()) {
            return ApiResponse::success($sessions, 'Class sessions retrieved successfully', 200);
        }

        return ApiResponse::error([], 'No class sessions found', 404);
    }

    /**
     * POST /api/v1/class-sessions
     * Store a newly created class session.
     *
     * @param StoreClassSessionRequest $request
     * @return JsonResponse
     */
    public function store(StoreClassSessionRequest $request): JsonResponse
    {
        $sessionData = collect($request->validated())->except('students')->toArray();

        $classSession = ClassSession::create($sessionData);

        if ($classSession && $request->has('students')) {
            $classSession->students()->attach($request->students);
        }

        return ApiResponse::success(
            $classSession->load(['cluster', 'staff', 'students']),
            'Class session created successfully',
            201
        );
    }

    /**
     * GET /api/v1/class-sessions/{id}
     * Display the specified class session.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $classSession = ClassSession::with(['cluster', 'staff', 'students'])->find($id);

        if ($classSession) {
            return ApiResponse::success($classSession, 'Class session found', 200);
        }

        return ApiResponse::error([], 'Class session not found', 404);
    }

    /**
     * PUT/PATCH /api/v1/class-sessions/{id}
     * Update the specified class session.
     *
     * @param UpdateClassSessionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateClassSessionRequest $request, $id): JsonResponse
    {
        $classSession = ClassSession::find($id);

        if (!$classSession) {
            return ApiResponse::error([], 'Class session not found', 404);
        }

        $sessionData = collect($request->validated())->except('students')->toArray();

        $classSession->update($sessionData);

        if ($request->has('students')) {
            $classSession->students()->sync($request->students);
        }

        return ApiResponse::success(
            $classSession->load(['cluster', 'staff', 'students']),
            'Class session updated successfully',
            200
        );
    }

    /**
     * DELETE /api/v1/class-sessions/{id}
     * Remove the specified class session.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $classSession = ClassSession::find($id);

        if (!$classSession) {
            return ApiResponse::error([], 'Class session not found', 404);
        }

        $classSession->delete();

        return ApiResponse::success(null, 'Class session deleted successfully', 200);
    }
}


