<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            // Tambahin baris ini biar sistem tahu siapa yang lapor
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('judul');
            $table->string('lokasi');
            $table->text('description');
            $table->string('foto')->nullable(); // Kasih nullable biar kalau gak ada foto gak error
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};