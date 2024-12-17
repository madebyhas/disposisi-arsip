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
        Schema::create('catatan_disposisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dispo')->constrained('disposisi', 'id_dispo')->onDelete('cascade');
            $table->foreignId('id_pegawai')->constrained('pegawai', 'id_pegawai')->onDelete('cascade');
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_disposisi');
    }
};
