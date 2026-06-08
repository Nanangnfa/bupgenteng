<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('monitorings', function (Blueprint $table) {

            if (Schema::hasColumn('monitorings', 'minggu_ke')) {
                $table->dropColumn('minggu_ke');
            }

            if (Schema::hasColumn('monitorings', 'ukuran_rata_rata')) {
                $table->dropColumn('ukuran_rata_rata');
            }

            if (Schema::hasColumn('monitorings', 'berat_rata_rata')) {
                $table->dropColumn('berat_rata_rata');
            }
        });
    }

    public function down(): void
    {
        Schema::table('monitorings', function (Blueprint $table) {
            $table->integer('minggu_ke')->nullable();
            $table->float('ukuran_rata_rata')->nullable();
            $table->float('berat_rata_rata')->nullable();
        });
    }
};
