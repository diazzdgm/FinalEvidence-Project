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
        Schema::create('role_user', function (Blueprint $table) {
            $table->id(); // Opcional, algunas personas prefieren no tener un id primario en tablas pivote
            $table->foreignId('role_id')->constrained('role')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->primary(['role_id', 'user_id']); // Descomentar si no usas $table->id() y quieres una clave primaria compuesta
            $table->timestamps(); // Opcional, si quieres rastrear cuándo se asignó un rol
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
