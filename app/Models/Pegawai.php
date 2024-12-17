<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pegawai extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'alamat',
        'jenis_kelamin',
        'telpon',
        'jabatan',
        'divisi',
        'hak_akses',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function catatan()
    {
        return $this->hasMany(Catatan_disposisi::class, 'id_pegawai');
    }
    public function suratMasuks()
    {
        return $this->hasMany(SuratMasuk::class, 'id_pegawai');
    }
    public function Arsip()
{
    return $this->hasMany(Arsip::class, 'id_pegawai', 'id_pegawai');
}

}
