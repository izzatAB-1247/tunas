<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_login', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('guru_user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('waktu_login');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_login');
    }
};
