<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\v1\CoreContent\StoreUnitRequest;
use App\Http\Requests\v1\CoreContent\UpdateUnitRequest;
use Illuminate\Http\JsonResponse;

/**
 * API V1 - UnitController
 */
class UnitController extends Controller
{
    /**
     * Display a listing of all the Units.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $units = Unit::all();

        if ($units) {
            return ApiResponse::success($units, 'All Units Found');
        }
        return ApiResponse::error($units, 'No Units Found');
    }

    /**
     * Store a newly created Unit in storage.
     * 
     * @param \App\Http\Requests\v1\CoreContent\StoreUnitRequest $request
     * @return JsonResponse
     */
    public function store(StoreUnitRequest $request): JsonResponse
    {
        $unit = Unit::create($request->all());
        
        if ($unit) {
            return ApiResponse::success($unit, "Unit Created", 201);
        }
        return ApiResponse::error($unit, "Unit Not Created", code: 404);
    }

    /**
     * Display the specified Unit.
     * 
     * @return JsonResponse
     */
    public function show(Unit $unit): JsonResponse
    {
        $unit = Unit::findOrFail($unit->id);

        if ($unit) {
            return ApiResponse::success($unit, 'Unit Found');
        }
        return ApiResponse::error($unit, 'Unit Not Found', 404);
    }

    /**
     * Update the specified Unit in storage.
     * 
     * @param \App\Http\Requests\v1\CoreContent\UpdateUnitRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUnitRequest $request, Unit $unit): JsonResponse
    {
        $unit = Unit::where('id', '=', $unit->id)->get()->first();

        $unit->update($request->all());

        if ($unit) {
            return ApiResponse::success($unit, 'Unit Upadated', 200);
        }
        return ApiResponse::error($unit, 'Unit Not Updated', 500);
    }

    /**
     * Remove the specified Unit from storage.
     */
    public function destroy(Unit $unit): JsonResponse
    {
        $unit = Unit::find($unit->id);

        if ($unit) {
            $unit->delete();
            return ApiResponse::success($unit,'Unit Succesfully Deleted');
        }
        return ApiResponse::error($unit,'Unit Not Deleted');
    }
}
