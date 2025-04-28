<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';


    public $timestamps = true;


    protected $fillable = [
        'nik',
        'nama_pasien',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'nomor_hp',
        'nomor_hp_keluarga',
        'riwayat_penyakit',
        'password',
    ];


    protected $hidden = [
        'password',
    ];


    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];
}
