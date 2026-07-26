<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim')->unique();
            $table->string('username')->unique();
            $table->string('photo')->nullable();
            $table->string('program_studi');
            $table->string('angkatan');
            $table->string('nomor_telepon');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama')->nullable();
            $table->string('email')->unique();
            $table->string('email_student')->nullable();
            $table->enum('asal_sekolah_jenis', ['SMA', 'SMK', 'MAN', 'Lainnya'])->nullable();
            $table->string('asal_sekolah_nama')->nullable();
            $table->string('jurusan_sekolah')->nullable();
            $table->string('asal_kota')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->enum('kota_kabupaten', ['Kota', 'Kabupaten'])->nullable();
            $table->enum('jalur_masuk', ['SNBP', 'SNBT', 'Mandiri UB', 'Mandiri Vokasi'])->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('role', ['admin', 'spv', 'mahasiswa'])->default('mahasiswa');
            $table->unsignedBigInteger('kelompok_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
