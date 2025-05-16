<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RiwayatAlarm;

class RiwayatAlarmController extends Controller
{
    public function index()
{
    $riwayat = Pasien::withCount([
        'alarm as total_alarm',
        'alarm as aktif' => fn($q) => $q->where('status', 'aktif'),
        'alarm as terlewat' => fn($q) => $q->where('status', 'terlewat'),
        'alarm as selesai' => fn($q) => $q->where('status', 'selesai'),
    ])->get();

    return view('riwayat.index', compact('riwayat'));
}


public function detail($id_pasien)
{
    $riwayat = RiwayatAlarm::whereHas('alarm', function($q) use ($id_pasien) {
        $q->where('id_pasien', $id_pasien);
    })->with(['alarm.obat'])->latest()->get();

    return view('riwayat.detail', compact('riwayat'));
}

}
