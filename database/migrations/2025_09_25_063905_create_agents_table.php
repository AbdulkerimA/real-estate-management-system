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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('media_id')->constrained('media')->onDelete('cascade');
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->string('bio',255)->nullable();
            $table->text('about_me');
            $table->string('address');
            $table->boolean('featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->enum('speciality',['apartments','houses','lands','commercial','luxury']);
            $table->unsignedTinyInteger('years_of_experience');
            $table->unsignedInteger('deals_closed')->default(0);
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
