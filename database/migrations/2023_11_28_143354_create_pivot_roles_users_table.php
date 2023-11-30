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
        Schema::create('pivot_roles_users', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->cascadeOnUpdate()->constrained();
            $table->foreignId('role_id')->cascadeOnUpdate()->constrained();
            $table->dateTime('expired_at')->default('2025-12-31 23:59:59');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        \DB::table('pivot_roles_users')->insert([
            'user_id' => '00000000-0000-0000-0000-000000000000',
            'role_id' => 1, 'expired_at' => '2049-12-31 23:59:59'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_roles_users');
    }
};
