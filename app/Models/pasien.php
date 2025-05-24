<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Pasien extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
        'usia',
    ];

    protected $hidden = [
        'password',
        'remember_token', // walaupun kamu mungkin tidak pakai ini, tetap aman disembunyikan
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

public function alarm() {
    return $this->hasMany(Alarm::class, 'id_pasien');
}

public function diagnosa() {
    return $this->hasMany(DiagnosaPenyakit::class, 'id_pasien');
}


    protected static function booted()
    {
        static::creating(function ($pasien) {
            if ($pasien->tanggal_lahir) {
                $pasien->usia = Carbon::parse($pasien->tanggal_lahir)->age;
            }
        });

        static::updating(function ($pasien) {
            if ($pasien->tanggal_lahir) {
                $pasien->usia = Carbon::parse($pasien->tanggal_lahir)->age;
            }
        });
    }
}
