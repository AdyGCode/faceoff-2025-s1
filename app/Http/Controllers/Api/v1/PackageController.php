<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StorePackageRequest;
use App\Http\Requests\v1\UpdatePackageRequest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();

        if ($packages) {
            return ApiResponse::success($packages, 'Found all packages');
        }
        return ApiResponse::error($packages, 'No packages Found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());
        return ApiResponse::success($package, "Package Created", 201);
    }  

    /**
     * Display the specified Package.
     * 
     */
    public function show(Package $package)
    {
        $package = Package::findOrFail($package->id);

        if ($package) {
            return ApiResponse::success($package, 'Package Found');
        }
        return ApiResponse::error($package, 'Package Not Found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, package $package)
    {
        $package = package::where('id', '=', $package->id)->get()->first();

        $package->update($request->all());

        if ($package) {
            return ApiResponse::success($package, 'Package Upadated', 200);
        }
        return ApiResponse::error($package, 'Package Not Updated', 500);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(package $package)
    {
        $package = package::find($package->id);

        if ($package) {
            $package->delete();
            return ApiResponse::success($package,'package Succesfully Deleted');
        }
        return ApiResponse::error($package,'package Not Deleted');
    }
}
