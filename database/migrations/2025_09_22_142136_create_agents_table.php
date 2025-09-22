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
        Schema::create('agents', function (Blueprint $table) {
            $table->id("agnet_id");
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->text('discription');
            $table->string('address');
            $table->integer('years_of_experience');
            $table->double('total_amount');
            $table->double('total_cashed_out');
            $table->double('remaining_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
