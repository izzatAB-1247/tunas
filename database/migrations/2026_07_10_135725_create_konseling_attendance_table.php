<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konseling_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('konseling_sessions')->cascadeOnDelete();
            $table->foreignId('siswa_id')->constrained('users')->cascadeOnDelete();
            $table->string('status')->default('hadir');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['session_id', 'siswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konseling_attendance');
    }
};
