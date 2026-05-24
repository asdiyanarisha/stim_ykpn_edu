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
        if (Schema::hasTable('pmb')) {
            Schema::table('pmb', function (Blueprint $table) {
                if (!Schema::hasColumn('pmb', 'id_pendaftar')) {
                    $table->string('id_pendaftar')->nullable()->after('id')->unique();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pmb')) {
            Schema::table('pmb', function (Blueprint $table) {
                if (Schema::hasColumn('pmb', 'id_pendaftar')) {
                    $table->dropColumn('id_pendaftar');
                }
            });
        }
    }
};
