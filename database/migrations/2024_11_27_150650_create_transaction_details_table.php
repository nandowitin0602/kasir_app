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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('transaction_detail_id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('quantity', 10, 2);
            $table->decimal('total_price', 10, 2);

            // Foreign key untuk transaction_id dengan onDelete cascade
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
            // Foreign key untuk item_id
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
