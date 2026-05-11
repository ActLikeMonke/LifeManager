<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workouts_layout', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Push Day" or "Leg Day"
            $table->timestamps();
        });

        // 2. The Exercise Library
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Incline Bench Press"
            $table->string('muscle_group');
            $table->timestamps();
        });

        // 3. The Pivot (Which exercises belong to which layout)
        Schema::create('exercise_workout_layout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_layout_id')->constrained('workouts_layout')->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->integer('sort_order')->default(0); // So you can order your workout
        });

        // 4. The Session (The actual event of going to the gym)
        Schema::create('workout_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_layout_id')->constrained('workouts_layout');
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->text('notes')->nullable(); // For "felt weak today" or "pre-workout kicked in"
        });

        // 5. The Sets (Linked to the SESSION)
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_session_id')->constrained('workout_sessions')->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('exercises');
            $table->decimal('weight', 8, 2); // Use decimal for 2.5kg plates or 12.5kg dumbbells
            $table->integer('reps');
            $table->integer('rpe')->nullable(); // Rated Perceived Exertion (very common in bodybuilding)
            $table->decimal('pr')->nullable(); // Personal Record for that exercise (optional)
            $table->boolean('is_warmup')->default(false);
            $table->timestamps();
        });

        Schema::create('cardio_sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->string('type'); // e.g., "Running", "Cycling"
            $table->decimal('distance', 8, 2)->nullable(); // in kilometers
            $table->decimal('average_heart_rate', 5, 2)->nullable(); // in bpm
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Chicken Breast"
            $table->integer('calories');
            $table->decimal('protein', 8, 2);
            $table->decimal('carbs', 8, 2);
            $table->decimal('fats', 8, 2);
            $table->timestamps();
        });

        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Lunch"
            $table->timestamps();
        });

        Schema::create('meal_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id')->constrained('meals')->onDelete('cascade');
            $table->timestamp('eaten_at');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        
        Schema::create('food_meal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id')->constrained('meals')->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');
            $table->decimal('quantity', 8, 2); // e.g., 150 grams of chicken breast
        });

        Schema::create('body_metrics', function (Blueprint $table) {
            $table->id();
            $table->decimal('weight', 8, 2); // in kg
            $table->decimal('body_fat_percentage', 5, 2)->nullable(); // e.g., 15.25%
            $table->decimal('muscle_mass', 8, 2)->nullable(); // in kg
            $table->timestamp('measured_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
