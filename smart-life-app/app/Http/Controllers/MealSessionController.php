<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertMealSessionRequest;
use App\Http\Resources\MealSessionResource;
use App\Models\MealSession;


class MealSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MealSessionResource::collection(MealSession::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(MealSession $mealSession)
    {
        return new MealSessionResource($mealSession);
    }   

    /**
     * Store a newly created resource in storage.
     */

    public function store(UpsertMealSessionRequest $request)
    {
        $validatedData = $request->validated();
        if (!isset($validatedData['eaten_at'])) {
            $validatedData['eaten_at'] = now();
        }
        $mealSession = MealSession::create($validatedData);
        
        return new MealSessionResource($mealSession);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpsertMealSessionRequest $request, MealSession $mealSession)
    {
        $mealSession->update($request->validated());
        
        return new MealSessionResource($mealSession);
    }

    public function destroy(MealSession $mealSession)
    {
        $mealSession->delete();   
        return response()->noContent();
    }
}