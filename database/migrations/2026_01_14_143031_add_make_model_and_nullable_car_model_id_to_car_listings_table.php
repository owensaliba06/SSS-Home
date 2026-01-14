<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('car_listings', function (Blueprint $table) {
            // add user-entered make/model
            $table->string('model')->after('title');
            $table->string('make')->after('model');

            // allow old FK to be optional (since we're not using dropdown anymore)
            $table->foreignId('car_model_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('car_listings', function (Blueprint $table) {
            $table->dropColumn(['make', 'model']);
            $table->foreignId('car_model_id')->nullable(false)->change();
        });
    }
};
