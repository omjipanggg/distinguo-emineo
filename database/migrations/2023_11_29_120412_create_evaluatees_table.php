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
        Schema::create('evaluatees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('card_number')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('area')->nullable()->index();
            $table->string('region')->nullable()->index();
            $table->string('zone')->nullable()->index();
            $table->string('avatar')->default('default.webp')->nullable()->index();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluatees');
    }
};
