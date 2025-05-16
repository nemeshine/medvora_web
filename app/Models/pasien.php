<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'usia', // tambahkan usia agar bisa diisi otomatis
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function alarm()
    {
        return $this->hasMany(Alarm::class, 'id_pasien', 'id_pasien');
    }

    // Hitung usia saat membuat dan memperbarui data
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
