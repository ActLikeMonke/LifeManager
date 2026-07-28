<?php

namespace App\Http\Controllers;

use App\Models\BodyMetric;
use App\Http\Requests\BodyMetricRequest;
use App\Http\Resources\BodyMetricResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BodyMetricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        // Fetching latest entries first, paginated for safety
        $metrics = BodyMetric::latest('measured_at')->paginate(15);
        
        return BodyMetricResource::collection($metrics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BodyMetricRequest $request): BodyMetricResource
    {
        $metric = new BodyMetric;
        $metric->weight = $request->input('weight');
        $metric->body_fat_percentage = $request->input('body_fat_percentage');
        $metric->muscle_mass = $request->input('muscle_mass');
        $metric->save();
        return new BodyMetricResource($metric);
    }

    /**
     * Display the specified resource.
     */
    public function show(BodyMetric $bodyMetric): BodyMetricResource
    {
        return new BodyMetricResource($bodyMetric);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BodyMetricRequest $request, BodyMetric $bodyMetric): BodyMetricResource
    {
        $bodyMetric->update($request->validated());

        return new BodyMetricResource($bodyMetric);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BodyMetric $bodyMetric): Response
    {
        $bodyMetric->delete();

        return response()->noContent(); // Returns 204 HTTP status code
    }
}