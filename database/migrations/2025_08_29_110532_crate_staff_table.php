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
        Schema::create('staff', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Primary key as UUID
            $table->string('staff_code')->unique(); // Unique staff code
            $table->string('full_name'); // Required field
            $table->string('phone'); // Required field (not nullable)
            $table->string('email')->unique()->nullable(); // Optional but unique
            $table->date('joining_date'); // Required field (not nullable)
            $table->string('address')->nullable();
            $table->uuid('role_id'); // Required field (not nullable)
            $table->string('shift_start_time')->nullable();
            $table->string('shift_end_time')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('id_proof')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('staff_roles')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
