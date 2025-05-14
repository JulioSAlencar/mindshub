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
        Schema::create('content_disciplines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discipline_id');
            $table->string('title');
            $table->string('file_path');
            $table->string('file_type');
            $table->bigInteger('file_size')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_disciplines');
    }
};
