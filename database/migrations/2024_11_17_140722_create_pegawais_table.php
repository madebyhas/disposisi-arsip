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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai', 35);
            $table->string('nip', 20);
            $table->string('alamat', 100);
            $table->string('jenis_kelamin', 35);
            $table->string('telpon', 14);
            $table->string('jabatan', 100);
            $table->string('divisi', 100);

            $table->string('hak_akses', 100);
            // $table->string('hak_akses', 100)->default('pagawai');            
            $table->string('username', 25)->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
