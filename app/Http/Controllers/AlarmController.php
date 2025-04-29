<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlarmController extends Controller
{
    // Tampilkan halaman utama Alarm
    public function index()
    {
        // Nanti di sini biasanya ambil data dari database
        return view('alarm.index');
    }

    // Tampilkan halaman detail Alarm untuk 1 pengguna
    public function detail($id)
    {
        // Bisa pakai $id buat filter alarm sesuai pasien
        return view('alarm.detail');
    }
}
