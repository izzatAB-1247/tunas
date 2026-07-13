<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konseling_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('konseling_groups')->cascadeOnDelete();
            $table->foreignId('siswa_id')->constrained('users')->cascadeOnDelete();
            $table->string('status')->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->unique(['group_id', 'siswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konseling_members');
    }
};
