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
        Schema::create('mission_user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mission_id')->constrained()->onDelete('cascade');
            $table->integer('progress')->default(0);
            $table->integer('time_remaining')->nullable();
            $table->timestamp('last_paused_at')->nullable();
            $table->timestamps();
    
            $table->unique(['user_id', 'mission_id']); // garante que um usuário tenha uma entrada por missão
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_user_progress');
    }
};
