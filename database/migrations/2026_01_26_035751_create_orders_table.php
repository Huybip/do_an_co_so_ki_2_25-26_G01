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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Reference to users table
            $table->string('customer_name'); // Name of the customer
            $table->string('customer_phone'); // Phone number of the customer
            $table->text('customer_address'); // Address of the customer
            $table->decimal('total_amount', 10, 2); // Total amount of the order
            $table->enum('status', ['pending', 'processing', 'shipping', 'completed', 'cancelled'])->default('pending'); // Status of the order
            $table->text('note')->nullable(); // Additional notes for the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
