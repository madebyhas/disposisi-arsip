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
        Schema::create('arsip', function (Blueprint $table) {
            $table->id('id_arsip');
            $table->date('tgl_arsip');
            $table->foreignId('id_dispo')->nullable()->constrained('disposisi', 'id_dispo')->onDelete('cascade');
            $table->foreignId('id_sm')->constrained('suratmasuk', 'id_sm')->onDelete('cascade');
            $table->foreignId('id_pegawai')->constrained('pegawai', 'id_pegawai')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip');
    }
};
