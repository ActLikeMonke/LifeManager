<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertSetRequest;
use App\Http\Resources\SetResource;
use App\Models\Set;

class SetController extends Controller
{
    public function index()
    {
        return SetResource::collection(Set::all());
    }

    public function store(UpsertSetRequest $request)
    {
        return (new SetResource(Set::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Set $set)
    {
        return new SetResource($set);
    }

    public function update(UpsertSetRequest $request, Set $set)
    {
        $set->update($request->validated());

        return new SetResource($set);
    }

    public function destroy(Set $set)
    {
        $set->delete();

        return response()->noContent();
    }
}