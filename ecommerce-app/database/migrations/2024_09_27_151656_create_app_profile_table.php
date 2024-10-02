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
        Schema::create('app_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('day_image', 255)->nullable(); 
            $table->string('night_image', 255)->nullable();
            $table->string('background_image', 255)->nullable();
            $table->char('primary', 7); 
            $table->char('secondary', 7); 
            $table->char('name_color', 7)->nullable();
            $table->char('title_color', 7)->nullable();
            $table->char('price_color', 7)->nullable();
            $table->char('body_color', 7)->nullable();
            $table->string('phone', 11);
            $table->string('email',50);
            $table->string('address');
            
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_profiles'); 
    }
};
