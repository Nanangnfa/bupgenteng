<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('monitorings');

        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bibit_id')
                ->constrained('bibits')
                ->cascadeOnDelete();

            $table->date('tanggal_monitoring');

            $table->integer('jumlah_mati')->default(0);

            $table->integer('stok_akhir');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
