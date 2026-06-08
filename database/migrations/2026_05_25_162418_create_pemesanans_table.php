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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();

            $table->string('kode_pemesanan');

            $table->foreignId('bibit_id')
                ->constrained('bibits')
                ->cascadeOnDelete();

            $table->string('nama_customer');

            $table->string('no_whatsapp');

            $table->text('alamat')->nullable();

            $table->integer('jumlah_pesan');

            $table->text('catatan')->nullable();

            $table->enum('status', [
                'pending',
                'disetujui',
                'ditolak',
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
