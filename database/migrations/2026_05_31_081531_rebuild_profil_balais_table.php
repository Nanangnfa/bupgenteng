<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('profil_balais');

        Schema::create('profil_balais', function (Blueprint $table) {
            $table->id();

            $table->string('nama_balai')->nullable();

            $table->text('sejarah')->nullable();

            $table->text('visi')->nullable();

            $table->text('misi')->nullable();

            $table->text('alamat')->nullable();

            $table->string('telepon')->nullable();

            $table->string('email')->nullable();

            $table->string('maps')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_balais');
    }
};
