<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nama_pasien', 'usia', 'jenis_kelamin', 'nomor_hp',
        'riwayat_penyakit', 'nomor_hp_keluarga', 'password'
    ];
}