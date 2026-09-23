<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertWorkoutSessionRequest;
use App\Http\Resources\WorkoutSessionResource;
use App\Models\WorkoutSession;

class WorkoutSessionController extends Controller
{
    public function index()
    {
        return WorkoutSessionResource::collection(WorkoutSession::all());
    }

    public function store(UpsertWorkoutSessionRequest $request)
    {
        return (new WorkoutSessionResource(WorkoutSession::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(WorkoutSession $workoutSession)
    {
        return new WorkoutSessionResource($workoutSession);
    }

    public function update(UpsertWorkoutSessionRequest $request, WorkoutSession $workoutSession)
    {
        $workoutSession->update($request->validated());

        return new WorkoutSessionResource($workoutSession);
    }

    public function destroy(WorkoutSession $workoutSession)
    {
        $workoutSession->delete();

        return response()->noContent();
    }
}