<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    // Aktifkan timestamps (created_at & updated_at)
    public $timestamps = true;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'nama_obat',
        'dosis',
        'efek_samping',
        'keterangan',
    ];

    // Casting tipe data
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
