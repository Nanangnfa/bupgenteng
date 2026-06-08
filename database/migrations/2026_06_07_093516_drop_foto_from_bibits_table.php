<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bibits', function (Blueprint $table) {
            if (Schema::hasColumn('bibits', 'foto')) {
                $table->dropColumn('foto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bibits', function (Blueprint $table) {
            $table->string('foto')->nullable();
        });
    }
};
