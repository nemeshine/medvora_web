<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaPenyakit extends Model
{
    use HasFactory;
    protected $table = 'diagnosa_penyakit';
    protected $primaryKey = 'id_diagnosa';
    public $timestamps = true;
    protected $fillable = [
        'id_pasien','id_staff',
        'tanggal_keluhan','keluhan',
        'tanggal_diagnosa','diagnosa',
        'resep_obat','catatan_tambahan'
    ];

    public function pasien() {
        return $this->belongsTo(Pasien::class,'id_pasien');
    }
    public function staff() {
        return $this->belongsTo(Staff::class,'id_staff');
    }
}
