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
        //
       Schema::create('staff', function (Blueprint $table) {
    $table->uuid('id')->primary();  // Primary key as UUID
    $table->string('full_name');
    $table->string('phone')->nullable();
    $table->string('email')->unique();
    $table->date('joining_date')->nullable();
    $table->string('address')->nullable();
    $table->string('role')->nullable();
    $table->uuid('role_id')->nullable(); // also UUID if staff_roles uses UUID
    $table->string('shift_start_time')->nullable();
    $table->string('shift_end_time')->nullable();
    $table->decimal('salary', 10, 2)->nullable();
    $table->string('profile_picture')->nullable();
    $table->string('id_proof')->nullable();
    $table->timestamps();

    $table->foreign('role_id')->references('id')->on('staff_roles')->onDelete('set null');
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
