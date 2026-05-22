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
                if (!Schema::hasColumn('pmb', 'pmb_status_id')) {
                    $table->unsignedBigInteger('pmb_status_id')->nullable()->after('id');
                    $table->foreign('pmb_status_id')->references('id')->on('pmb_status')->onDelete('set null');
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
                if (Schema::hasColumn('pmb', 'pmb_status_id')) {
                    $table->dropForeign(['pmb_status_id']);
                    $table->dropColumn('pmb_status_id');
                }
            });
        }
    }
};
