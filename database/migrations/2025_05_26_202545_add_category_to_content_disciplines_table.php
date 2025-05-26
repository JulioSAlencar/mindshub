<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_disciplines', function (Blueprint $table) {
            $table->string('category')->after('file_size')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('content_disciplines', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
