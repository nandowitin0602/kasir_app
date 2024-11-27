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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id'); // Primary Key
            $table->string('item_code', 50);
            $table->string('item_name', 200);
            $table->decimal('item_price', 10, 2);
            $table->decimal('stock', 10, 2);
            $table->enum('selling_unit', ['/kg', '/satuan'])->default('/kg');
            $table->enum('is_deleted', ['y', 'n'])->default('n');
            $table->timestamps();
            $table->unsignedBigInteger('store_id')->nullable(); // Foreign key
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');
        
            // Unique constraint untuk kombinasi store_id dan item_code
            $table->unique(['store_id', 'item_code'], 'store_item_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
