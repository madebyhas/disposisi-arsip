<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $pegawai = Pegawai::create([
            'nama_pegawai' => 'Upi',
            'nip' => '12345678910',
            'alamat' => 'Kudus',
            'jenis_kelamin' => 'Laki-laki',
            'telpon' => '081200300400',
            'jabatan' => 'Sub Bag Kepegawaian',
            'divisi' => 'Bagian Hubungan Langganan',
            'hak_akses' => 'Pegawai',
            // login
            'username' => 'pegawai',
            'password' => bcrypt('pegawai123'),
        ]);
        
        $dirut = Pegawai::create([
            'nama_pegawai' => 'Hadi',
            'nip' => '01987654321',
            'alamat' => 'Kudus',
            'jenis_kelamin' => 'Laki-laki',
            'telpon' => '081300200400',
            'jabatan' => 'Sub Bag Sekretariat',
            'divisi' => 'Bagian Umum',
            'hak_akses' => 'Direktur',
            // login
            'username' => 'direktur',
            'password' => bcrypt('dir123'),
        ]);
        
        $kabag = Pegawai::create([
            'nama_pegawai' => 'Sri',
            'nip' => '01987654321',
            'alamat' => 'Kudus',
            'jenis_kelamin' => 'Perempuan',
            'telpon' => '081300200400',
            'jabatan' => 'Sub Bag Kas',
            'divisi' => 'Bagian Umum',
            'hak_akses' => 'Kepala Bagian',
            // login
            'username' => 'kabag',
            'password' => bcrypt('kabag123'),
        ]);
        
        $kabag = Pegawai::create([
            'nama_pegawai' => 'Tri',
            'nip' => '01987654321',
            'alamat' => 'Kudus',
            'jenis_kelamin' => 'Perempuan',
            'telpon' => '081300200400',
            'jabatan' => 'Sub Bag Kas',
            'divisi' => 'Bagian Umum',
            'hak_akses' => 'Kepala SubBagian',
            // login
            'username' => 'kasubag',
            'password' => bcrypt('kasubag123'),
        ]);
    }
}
