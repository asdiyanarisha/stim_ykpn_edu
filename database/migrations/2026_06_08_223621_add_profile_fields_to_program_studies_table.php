<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_studies', function (Blueprint $table) {
            // URL slug untuk routing publik: /program/s1-manajemen
            $table->string('slug', 100)->unique()->nullable()->after('grade');

            // Konten halaman profil prodi
            $table->text('tagline')->nullable()->after('slug');
            $table->longText('description')->nullable()->after('tagline');
            $table->string('image_banner', 255)->nullable()->after('description');

            // Statistik prodi (tampil di hero)
            $table->string('study_duration', 50)->nullable()->after('image_banner');   // "4 Tahun"
            $table->string('degree_title', 50)->nullable()->after('study_duration'); // "S.M."
            $table->smallInteger('total_sks')->unsigned()->nullable()->after('degree_title'); // 144
            $table->string('accreditation', 100)->nullable()->after('total_sks');  // "Baik Sekali"

            // Kontrol tampil & urutan
            $table->boolean('is_active')->default(true)->after('accreditation');
            $table->smallInteger('order')->default(0)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('program_studies', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'tagline', 'description', 'image_banner',
                'study_duration', 'degree_title',
                'total_sks', 'accreditation', 'is_active', 'order',
            ]);
        });
    }
};
