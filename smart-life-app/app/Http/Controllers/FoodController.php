<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Resources\FoodResource;
use App\Http\Requests\UpsertFoodRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FoodResource::collection(Food::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertFoodRequest $request)
    {
        $validated = $request->validated();
        $food = Food::create($validated);
        return new FoodResource($food);
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return new FoodResource($food);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertFoodRequest $request, Food $food)
    {
        $validated = $request->validated();
        $food->update($validated);
        return new FoodResource($food);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
    }
}
