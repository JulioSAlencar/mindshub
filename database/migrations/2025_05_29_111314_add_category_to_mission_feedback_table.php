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
    Schema::table('mission_feedback', function (Blueprint $table) {
        $table->string('category')->nullable()->after('content');
    });
}

public function down(): void
{
    Schema::table('mission_feedback', function (Blueprint $table) {
        $table->dropColumn('category');
    });
}
};
