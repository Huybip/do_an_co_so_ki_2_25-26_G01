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
        Schema::create('breads', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //Name of the bread
            $table->text('description'); //Description of the bread
            $table->decimal('price', 10, 2); //Price of the bread
            $table->string('image')->nullable(); //Image URL of the bread
            $table->integer('stock')->default(0); //Stock quantity
            $table->boolean('is_available')->default(true); //Availability status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breads');
    }
};
