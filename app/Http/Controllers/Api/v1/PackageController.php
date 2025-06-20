<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CoreContent\StorePackageRequest;
use App\Http\Requests\v1\CoreContent\UpdatePackageRequest;
use Illuminate\Http\JsonResponse;


/**
 * API V1 - PackageController
 */
class PackageController extends Controller
{
    /**
     * Display a listing of all the Packages.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $packages = Package::all();

        if ($packages) {
            return ApiResponse::success($packages, 'Found all packages', 200);
        }
        return ApiResponse::error($packages, 'No packages Found', 404);
    }

    /**
     * Store a newly created Package in storage.
     * 
     * @param \App\Http\Requests\v1\CoreContent\StorePackageRequest $request
     * @return JsonResponse
     */
    public function store(StorePackageRequest $request): JsonResponse
    {
        $package = Package::create($request->all());

        if ($package) {
            return ApiResponse::success($package, "Package Created", 201);
        }
        return ApiResponse::error($package, "Package Not Created", 404);
    }  

    /**
     * Display the specified Package.
     * 
     * @return JsonResponse
     */
    public function show(Package $package): JsonResponse
    {
        $package = Package::findOrFail($package->id);

        if ($package) {
            return ApiResponse::success($package, 'Package Found', 200);
        }
        return ApiResponse::error($package, 'Package Not Found', 404);
    }

    /**
     * Update the specified Package in storage.
     * 
     * @param \App\Http\Requests\v1\CoreContent\UpdatePackageRequest $request
     * @return JsonResponse
     */
    public function update(UpdatePackageRequest $request, Package $package): JsonResponse
    {
        $package = package::where('id', '=', $package->id)->get()->first();

        $package->update($request->all());

        if ($package) {
            return ApiResponse::success($package, 'Package Upadated', 200);
        }
        return ApiResponse::error($package, 'Package Not Updated', code: 500);

    }

    /**
     * Remove the specified Package from storage.
     * 
     * @return JsonResponse
     */
    public function destroy(package $package): JsonResponse
    {
        $package = package::find($package->id);

        if ($package) {
            $package->delete();
            return ApiResponse::success($package,'Package Succesfully Deleted' ,200);
        }
        return ApiResponse::error($package,'Package Not Deleted', 500);
    }
}
