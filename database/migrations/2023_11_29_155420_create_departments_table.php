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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('snake_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        \DB::table('departments')->insert([
            ['name' => 'Visitor', 'snake_name' => 'visitor'],
            ['name' => 'Teknisi', 'snake_name' => 'teknisi'],
            ['name' => 'Telecollection', 'snake_name' => 'telecollection'],
            ['name' => 'Admin', 'snake_name' => 'admin'],
            ['name' => 'Sekretaris', 'snake_name' => 'sekretaris']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
