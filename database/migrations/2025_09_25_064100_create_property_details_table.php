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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->decimal('area_size', 8, 2);
            $table->unsignedTinyInteger('bed_rooms');
            $table->unsignedTinyInteger('bath_rooms');
            $table->boolean('balcony');
            $table->boolean('swimming_pool');
            $table->boolean('garden');
            $table->boolean('gym');
            $table->boolean('security');
            $table->boolean('parking');
            $table->year("year_built");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_details');
    }
};
