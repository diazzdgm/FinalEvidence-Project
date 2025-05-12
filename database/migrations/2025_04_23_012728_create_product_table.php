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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Description');
            $table->float('Unit_Price');
            $table->integer('Stock');
            $table->unsignedBigInteger('Warehouse');
            $table->foreign('Warehouse') -> references('id')->on('werehouse');
            $table->unsignedBigInteger('Category_ID');
            $table->foreign('Category_ID')->nullable() -> references('id')->on('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
