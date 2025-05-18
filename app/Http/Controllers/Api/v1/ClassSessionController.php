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
     * Display a listing of all class sessions.
     */
    public function index(): JsonResponse
    {
        $sessions = ClassSession::with(['cluster', 'staff', 'students'])->get();

        if ($sessions->isNotEmpty()) {
            return ApiResponse::success($sessions, 'Found all Class Sessions');
        }

        return ApiResponse::error([], 'No Class Sessions found');
    }

    /**
     * Store a newly created class session.
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
            'Class session created',
            201
        );
    }

    /**
     * Display the specified class session.
     */
    public function show($id): JsonResponse
    {
        $classSession = ClassSession::with(['cluster', 'staff', 'students'])->find($id);

        if ($classSession) {
            return ApiResponse::success($classSession, 'Class session found');
        }

        return ApiResponse::error([], 'Class session not found', 404);
    }

    /**
     * Update the specified class session.
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
            'Class session updated'
        );
    }

    /**
     * Remove the specified class session.
     */
    public function destroy($id): JsonResponse
    {
        $classSession = ClassSession::find($id);

        if (!$classSession) {
            return ApiResponse::error([], 'Class session not found', 404);
        }

        $classSession->delete();

        return ApiResponse::success(null, 'Class session deleted');
    }
}


