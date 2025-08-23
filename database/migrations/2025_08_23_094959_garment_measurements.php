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
   Schema::create('garment_measurement', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('garment_id');
    $table->unsignedBigInteger('measurement_id');

    $table->foreign('garment_id')->references('id')->on('garments')->onDelete('cascade');
    $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('cascade');

    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garment_measurement');
    }
};
