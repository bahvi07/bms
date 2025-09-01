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
        Schema::create('salaries', function (Blueprint $table) {
    $table->id();
    $table->uuid('uuid')->unique(); // Optional, for external reference

    // FK must match staff.id type
    $table->uuid('staff_id');
    $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');

    $table->decimal('base_salary', 10, 2);
    $table->decimal('amount_paid', 10, 2)->default(0);   // fixed typo (ampount_paid -> amount_paid)
    $table->decimal('pending_amount', 10, 2)->default(0);
    $table->date('payment_date')->nullable();
    $table->string('payment_method')->nullable();
    $table->decimal('balance', 10, 2)->default(0);
    $table->decimal('bounce', 10, 2)->default(0);
    $table->decimal('deduction', 10, 2)->default(0);
    $table->string('month')->nullable();
    $table->string('year')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
