<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('performance_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->string('area'); 
            $table->float('accuracy')->default(0); // % de acertos
            $table->integer('average_time')->default(0); // em segundos
            $table->float('completion_rate')->default(0); // % de conclusão
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_metrics');
    }
};
