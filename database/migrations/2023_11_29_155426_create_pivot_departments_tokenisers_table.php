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
        Schema::create('pivot_departments_tokenisers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tokeniser_id')->index();
            $table->unsignedBigInteger('department_id')->index();
            $table->unsignedBigInteger('assessment_id')->default(1)->nullable()->index();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        \DB::table('pivot_departments_tokenisers')->insert([
            ['tokeniser_id' => 1, 'department_id' => 1],
            ['tokeniser_id' => 1, 'department_id' => 3],
            ['tokeniser_id' => 2, 'department_id' => 3],
            ['tokeniser_id' => 3, 'department_id' => 1],
            ['tokeniser_id' => 3, 'department_id' => 2],
            ['tokeniser_id' => 4, 'department_id' => 1],
            ['tokeniser_id' => 5, 'department_id' => 5],
            ['tokeniser_id' => 5, 'department_id' => 4],
            ['tokeniser_id' => 6, 'department_id' => 4],
            ['tokeniser_id' => 7, 'department_id' => 1],
            ['tokeniser_id' => 7, 'department_id' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_tokenisers_departments');
    }
};
