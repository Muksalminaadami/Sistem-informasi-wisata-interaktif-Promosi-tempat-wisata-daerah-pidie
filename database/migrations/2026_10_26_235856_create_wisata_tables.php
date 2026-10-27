<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Tabel Kategori (ERD: id, nama_kategori, deskripsi)
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel Wilayah (ERD: id, nama_wilayah, deskripsi)
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel Destinasi (ERD: id, nama_destinasi, kategori_id, wilayah_id, deskripsi, lokasi_map, foto)
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_destinasi');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->foreignId('wilayah_id')->constrained('wilayah')->onDelete('cascade');
            $table->text('deskripsi');
            $table->string('lokasi_map')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        // Tabel Admin (ERD: id, username, password)
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('destinasi');
        Schema::dropIfExists('wilayah');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('admin');
    }
};