<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->longText('content')->after('title');
            $table->string('url_image')->nullable()->after('content');
            $table->integer('views_count')->default(0)->after('url_image');
            $table->string('status')->default('draft')->after('views_count');
            $table->unsignedBigInteger('created_by')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            $table->dropColumn(['title', 'content', 'url_image', 'views_count', 'status', 'created_by']);
        });
    }
};
