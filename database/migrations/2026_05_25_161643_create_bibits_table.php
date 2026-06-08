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
        Schema::create('bibits', function (Blueprint $table) {

            $table->id();

            $table->string('kode_bibit');

            $table->string('nama_ikan');

            $table->date('tanggal_tebar')->nullable();

            $table->integer('jumlah_awal')->nullable();

            $table->integer('stok_sekarang')->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('foto')->nullable();

            $table->enum('status', [
                'tersedia',
                'habis'
            ])->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibits');
    }
};
