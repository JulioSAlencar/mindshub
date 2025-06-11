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
        Schema::create('mission_trail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trail_id')->constrained('trails')->onDelete('cascade');
            $table->foreignId('mission_id')->constrained('missions')->onDelete('cascade');
            $table->unsignedInteger('order')->nullable()->comment('Ordem da missão na trilha'); // Opcional
            $table->timestamps(); // Opcional, se precisar rastrear quando uma missão foi adicionada à trilha

            // Garante que uma missão não seja adicionada duas vezes na mesma trilha
            $table->unique(['trail_id', 'mission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_trail');
    }
};
