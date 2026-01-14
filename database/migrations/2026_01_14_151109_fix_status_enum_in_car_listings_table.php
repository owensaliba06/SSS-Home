<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
public function up(): void
{
    DB::statement("
        ALTER TABLE car_listings
        MODIFY status ENUM('available','sold')
        NOT NULL
        DEFAULT 'available'
    ");
}

public function down(): void
{
    DB::statement("
        ALTER TABLE car_listings
        MODIFY status ENUM('available','sold')
        NOT NULL
        DEFAULT 'available'
    ");
    }
};
