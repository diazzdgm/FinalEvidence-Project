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
        Schema::create('inventory_movement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Product_ID');
            $table->foreign('Product_ID') -> references('id')->on('product');
            $table->string('Movement_Type');
            $table->integer('Quantity');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID') -> references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movement');
    }
};
