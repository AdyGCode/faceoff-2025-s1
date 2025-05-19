<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\Cluster;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CoreContent\StoreClusterRequest;
use App\Http\Requests\v1\CoreContent\UpdateClusterRequest;
use Illuminate\Http\JsonResponse;

/**
 * API V1 - ClusterController
 */
class ClusterController extends Controller
{
    /**
     * Display a listing of all the Clusters.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $clusters = Cluster::all();

        if ($clusters) {
            return ApiResponse::success($clusters, 'All Clusters Found');
        }
        return ApiResponse::error($clusters, 'No Clusters Found');
    }

    /**
     * Store a newly created Cluster in storage.
     * 
     * @param \App\Http\Requests\v1\StoreClusterRequest $request
     * @return JsonResponse
     */
    public function store(StoreClusterRequest $request): JsonResponse
    {
        $cluster = Cluster::create($request->all());
        
        if ($cluster) {
            return ApiResponse::success($cluster, "Cluster Created", 201);
        }
        return ApiResponse::error($cluster, "Cluster Not Created", code: 404);
    }

    /**
     * Display the specified cluster.
     * 
     * @return JsonResponse
     */
    public function show(Cluster $cluster): JsonResponse
    {
        $cluster = Cluster::findOrFail($cluster->id);

        if ($cluster) {
            return ApiResponse::success($cluster, 'Cluster Found');
        }
        return ApiResponse::error($cluster, 'Cluster Not Found', 404);
    }

    /**
     * Update the specified Cluster in storage.
     * 
     * @param \App\Http\Requests\v1\UpdateClusterRequest $request
     * @return JsonResponse
     */
    public function update(UpdateClusterRequest $request, Cluster $cluster): JsonResponse
    {
        $cluster = Cluster::where('id', '=', $cluster->id)->get()->first();

        $cluster->update($request->all());

        if ($cluster) {
            return ApiResponse::success($cluster, 'Cluster Upadated', 200);
        }
        return ApiResponse::error($cluster, 'Cluster Not Updated', 500);
    }

    /**
     * Remove the specified Cluster from storage.
     */
    public function destroy(Cluster $cluster): JsonResponse
    {
        $cluster = Cluster::find($cluster->id);

        if ($cluster) {
            $cluster->delete();
            return ApiResponse::success($cluster,'Cluster Succesfully Deleted');
        }
        return ApiResponse::error($cluster,'Cluster Not Deleted');
    }
}
