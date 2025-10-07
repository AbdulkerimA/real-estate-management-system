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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('language')->default('en');
            $table->string('time_zone')->default('UTC');
            $table->boolean('email_notification')->default(true);
            $table->boolean('sms_notification')->default(false);
            $table->boolean('appointment_reminder')->default(true);
            $table->boolean('two_factor_authentication')->default(true);
            $table->boolean('allow_direct_message')->default(false);
            $table->boolean('show_online_statatus')->default(false);
            $table->boolean('deactivated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
