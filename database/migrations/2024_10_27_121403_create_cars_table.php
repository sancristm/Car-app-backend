<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('car_name');
        $table->string('model');
        $table->decimal('price', 10, 2);
        $table->boolean('availability_status')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
