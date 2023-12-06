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
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->unsignedBigInteger('criteria_type_id')->index();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        \DB::table('criterias')->insert([
            ['criteria_type_id' => 1, 'name' => 'Hasil Penilaian', 'id' => 999],
            ['criteria_type_id' => 1, 'name' => 'Customer Service Orientation', 'description' => 'Secara proaktif mengembangkan hubungan dengan pelanggan melalui upaya mendengarkan dan memahami pelanggan (internal dan eksternal), mengantisipasi dan menyediakan solusi sesuai kebutuhan pelanggan, memprioritaskan kepuasan pelanggan.'],
            ['criteria_type_id' => 1, 'name' => 'Fleksibilitas Berpikir', 'description' => 'Bersedia untuk mengubah pola pikir dan cara kerja agar sesuai dengan kondisi dan tuntutan pekerjaan yang berbeda serta mampu mengembangkan dan menggunakan pendekatan inovasi dalam bekerja.'],
            ['criteria_type_id' => 1, 'name' => 'Organizational Awareness', 'description' => 'Memahami struktur organisasi dan visi misi perusahaan secara keseluruhan, mengaplikasikan praktek bisnis dan mendapatkan sumber daya yang dibutuhkan untuk merencanakan dan menyelesaikan pekerjaan.'],
            ['criteria_type_id' => 1, 'name' => 'Planning & Organizing', 'description' => 'Membuat rancangan rangkaian tindakan untuk diri sendiri dan kelompok dalam rangka mencapai tujuan spesifik, merencanakan pengalokasian waktu dan sumber daya secara tepat, serta melakukan monitoring terhadap implementasinya.'],
            ['criteria_type_id' => 1, 'name' => 'Problem Solving', 'description' => 'Kemampuan untuk mengidentifikasi masalah, mengetahui penyebab dan alasan yang masuk akal dalam kurun waktu tertentu, serta mengidentifikasi alternatif solusi.'],
            ['criteria_type_id' => 2, 'name' => 'Strength'],
            ['criteria_type_id' => 2, 'name' => 'Weakness']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
