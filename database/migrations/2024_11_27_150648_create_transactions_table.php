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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price', 10, 2);
            $table->timestamp('transaction_date')->nullable();

            // Foreign key untuk store_id dengan onDelete cascade
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');

            // Unique constraint untuk kombinasi store_id dan transaction_id
            $table->unique(['store_id', 'transaction_id'], 'store_transaction_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
