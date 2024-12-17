<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan_disposisi extends Model
{
    use HasFactory;

    protected $table = 'catatan_disposisi';

    protected $fillable = ['id_dispo', 'id_pegawai', 'catatan'];

    // Relasi ke disposisi
    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class);
    }

    // Relasi ke pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
