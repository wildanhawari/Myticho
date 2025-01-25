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
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jewelry_transaction_id')->constrained()->cascadeOnDelete(); // Reference to the transaction table
            $table->foreignId('jewelry_id')->constrained()->cascadeOnDelete(); // Reference to the jewelry table
            $table->unsignedInteger('quantity');  // Quantity of the item
            $table->unsignedBigInteger('sub_total_amount'); // Subtotal amount for this item
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
