<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    
    protected $table = 'arsip';

    protected $primaryKey = 'id_arsip';

    protected $fillable = [
        'tgl_arsip',
        'id_dispo',
        'id_sm',
        'id_pegawai',
    ];

     // Relasi ke Suartmasuk
    public function suratmasuk()
    {
        return $this->hasOne(Suratmasuk::class, 'id_sm');
    }
    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'id_dispo');
    }
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
