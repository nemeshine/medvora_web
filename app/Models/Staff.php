<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    // Tentukan nama tabel menjadi 'staff'
    protected $table = 'staff';

    // Tentukan primary key jika berbeda dari 'id'
    protected $primaryKey = 'id_staff';

    // Field yang dapat diisi
    protected $fillable = [
        'nama_staff', 'email', 'password'
    ];

    // Sembunyikan field password ketika model diubah ke array/JSON (opsional)
    protected $hidden = [
        'password',
    ];
}
