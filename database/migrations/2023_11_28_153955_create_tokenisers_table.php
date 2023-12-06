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
        Schema::create('tokenisers', function (Blueprint $table) {
            $table->id();
            $table->string('token')->nullable()->index();
            $table->string('region')->nullable()->index();
            $table->string('zone')->nullable()->index();
            $table->boolean('is_used')->default(0)->nullable()->index();
            $table->datetime('used_at')->nullable()->index();
            $table->datetime('expired_at')->default('2031-12-31 23:59:59')->nullable()->index();
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
        Schema::dropIfExists('tokenisers');
    }
};
