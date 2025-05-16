<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $table = 'alarm';
    protected $primaryKey = 'id_alarm';

    protected $fillable = [
        'id_pasien',
        'id_obat',
        'takaran',
        'id_staff',
        'waktu_minum',
        'tanggal_mulai',
        'tanggal_selesai',
        'instruksi',
        'status',
        'total_obat',
    ];


    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }


    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }


    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff');
    }

    public function riwayat()
{
    return $this->hasMany(RiwayatAlarm::class, 'id_alarm', 'id_alarm');
}

}
