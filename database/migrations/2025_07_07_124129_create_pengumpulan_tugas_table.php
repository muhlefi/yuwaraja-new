<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('kelompok_id')->nullable();
            $table->string('file_path')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['draft', 'submitted', 'reviewed', 'approved', 'rejected', 'done'])->default('draft');
            $table->integer('nilai')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->foreign('kelompok_id')->references('id')->on('kelompoks')->onDelete('cascade');
            $table->index('user_id');
            $table->index('kelompok_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
