<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add FK from kelompoks to users (spv)
        Schema::table('kelompoks', function (Blueprint $table) {
            $table->foreign('spv_id')->references('id')->on('users')->onDelete('set null');
        });

        // Add FK from users to kelompoks
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('kelompok_id')->references('id')->on('kelompoks')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kelompok_id']);
        });
        Schema::table('kelompoks', function (Blueprint $table) {
            $table->dropForeign(['spv_id']);
        });
    }
};
