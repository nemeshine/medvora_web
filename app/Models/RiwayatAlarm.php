<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAlarm extends Model
{
    use HasFactory;

    protected $table = 'riwayat_alarm';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = true;

    protected $fillable = [
        'id_alarm',
        'tanggal',
        'status',
        'waktu_aksi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_aksi' => 'datetime',
    ];


    public function alarm()
{
    return $this->belongsTo(Alarm::class, 'id_alarm', 'id_alarm');
}

}
