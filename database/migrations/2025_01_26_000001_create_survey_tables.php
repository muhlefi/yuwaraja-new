<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_survey', function (Blueprint $table) {
            $table->id('id_master_survey');
            $table->string('judul_survey');
            $table->text('deskripsi_survey')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('detil_survey', function (Blueprint $table) {
            $table->id('id_detil_survey');
            $table->foreignId('id_master_survey')->constrained('master_survey', 'id_master_survey')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->enum('tipe_pertanyaan', ['text', 'textarea', 'radio', 'checkbox', 'select']);
            $table->json('opsi_jawaban')->nullable();
            $table->boolean('wajib_diisi')->default(false);
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

        Schema::create('hasil_survey', function (Blueprint $table) {
            $table->id('id_hasil_survey');
            $table->foreignId('id_master_survey')->constrained('master_survey', 'id_master_survey')->onDelete('cascade');
            $table->foreignId('id_detil_survey')->constrained('detil_survey', 'id_detil_survey')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('jawaban');
            $table->timestamps();

            $table->unique(['id_detil_survey', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_survey');
        Schema::dropIfExists('detil_survey');
        Schema::dropIfExists('master_survey');
    }
};
