<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Resources\MealResource;
use App\Http\Requests\UpsertMealRequest;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = Meal::with('foods')->get();
        return MealResource::collection($meals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertMealRequest $request)
{
    // Validate the request data
    $validated = $request->validated();

    $meal = Meal::create(['name' => $validated['name']]);

    // Format the foods for attaching to the meal
    $formattedFoods = [];
    foreach ($validated['foods'] as $food) {
        $formattedFoods[$food['id']] = [
            'quantity' => $food['quantity']
        ];
    }

    $meal->foods()->attach($formattedFoods);
    $meal->load('foods');
    return new MealResource($meal);
}

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        return new MealResource($meal->load('foods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertMealRequest $request, Meal $meal)
    {
        $validated = $request->validated();
        $meal->update(['name' => $validated['name']]);

        // Format the foods for syncing with the meal
        $formattedFoods = [];
        foreach ($validated['foods'] as $food) {
            $formattedFoods[$food['id']] = [
                'quantity' => $food['quantity']
            ];
        }

        $meal->foods()->sync($formattedFoods);
        $meal->load('foods');
        return new MealResource($meal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        return response()->noContent();
    }
}
