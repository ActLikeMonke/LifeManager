<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function index()
    {
        return ExerciseResource::collection(Exercise::all());
    }

    public function store(UpsertExerciseRequest $request)
    {
        return (new ExerciseResource(Exercise::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Exercise $exercise)
    {
        return new ExerciseResource($exercise);
    }

    public function update(UpsertExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());

        return new ExerciseResource($exercise);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return response()->noContent();
    }
}