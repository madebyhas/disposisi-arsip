<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';

    protected $primaryKey = 'id_dispo';

    protected $fillable = [
        'no_agenda',
        'sifat',
        'keterangan',
        'id_sm',
    ];

    // Relasi ke Suartmasuk
    public function suratmasuk()
    {
        return $this->belongsTo(Suratmasuk::class, 'id_sm');
    }

    // Relasi ke model Catatan_disposisi melalui id_pegawai
    public function catatan()
    {
        return $this->hasMany(Catatan_disposisi::class, 'id_dispo');
    }
    // Relasi ke model arsip melalui id_dispo
    public function arsip()
    {
        return $this->hasOne(Arsip::class, 'id_dispo');
    }

}
