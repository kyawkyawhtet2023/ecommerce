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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('name');
            $table->string('image');
            $table->string('barcode')->nullable();
            $table->string('sku')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->string('weight');
            $table->string('length', 10)->nullable();
            $table->string('height', 10)->nullable();
            $table->string('width', 10)->nullable();
            $table->boolean('is_active')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_item');
    }
};
