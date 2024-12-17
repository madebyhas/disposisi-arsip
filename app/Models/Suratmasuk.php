<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratmasuk extends Model
{
    use HasFactory;

    protected $table = 'suratmasuk';

    protected $primaryKey = 'id_sm';

    protected $fillable = [
        'tgl_diterima',
        'no_surat',
        'tgl_surat',
        'asal_surat',
        'perihal',
        'tujuan_dispo',
        'lampiran',
        'id_pegawai',
    ];

    // Definisi relasi dengan model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai'); // 'id_pegawai' adalah kolom yang menghubungkan SuratMasuk dengan Pegawai
    }
    
    // Definisi relasi dengan model Pegawai
    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'id_sm'); // 'id_pegawai' adalah kolom yang menghubungkan SuratMasuk dengan Pegawai
    }
}
