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
        Schema::create('pivot_assessments_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id')->index();
            $table->unsignedBigInteger('criteria_id')->index();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        \DB::table('pivot_assessments_criterias')->insert([
            ['assessment_id' => 1, 'criteria_id' => 1],
            ['assessment_id' => 1, 'criteria_id' => 2],
            ['assessment_id' => 1, 'criteria_id' => 3],
            ['assessment_id' => 1, 'criteria_id' => 4],
            ['assessment_id' => 1, 'criteria_id' => 5],
            ['assessment_id' => 1, 'criteria_id' => 6],
            ['assessment_id' => 1, 'criteria_id' => 7],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_assessments_criterias');
    }
};
