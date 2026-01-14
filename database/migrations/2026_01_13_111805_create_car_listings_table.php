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
        Schema::create('car_listings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_model_id')->constrained('car_models')->restrictOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->unsignedInteger('year');
            $table->unsignedInteger('mileage')->nullable();

            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric', 'other'])->default('other');
            $table->enum('transmission', ['manual', 'automatic', 'other'])->default('other');

            $table->unsignedInteger('price');
            $table->string('location');

            $table->text('description')->nullable();
            $table->enum('status', ['available', 'sold',])->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_listings');
    }
};
