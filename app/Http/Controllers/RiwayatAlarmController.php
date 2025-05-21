<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RiwayatAlarm;
use Illuminate\Http\Request;

class RiwayatAlarmController extends Controller
{
    public function index(Request $request)
    {

                if (!session()->has('id_staff')) {
            return redirect('/login');
        }

        $query = Pasien::withCount([
            'alarm as total_alarm',
            'alarm as aktif' => fn($q) => $q->where('status', 'aktif'),
            'alarm as terlewat' => fn($q) => $q->where('status', 'terlewat'),
            'alarm as selesai' => fn($q) => $q->where('status', 'selesai'),
        ])
        ->withMax('alarm', 'created_at');

        // Fitur pencarian
        if ($request->filled('search')) {
            $query->where('nama_pasien', 'like', '%' . $request->search . '%');
        }

        // Urut berdasarkan alarm terbaru, dan paginasi 10 per halaman
    $riwayat = $query->orderBy('created_at', 'desc')->paginate(10);
        //$pasiens = $query->orderBy('created_at', 'desc')

        return view('riwayat.index', compact('riwayat'));
    }

    public function detail($id_pasien)
    {
        $riwayat = RiwayatAlarm::whereHas('alarm', function ($q) use ($id_pasien) {
            $q->where('id_pasien', $id_pasien);
        })->with(['alarm.obat'])
          ->latest()
          ->get();

        return view('riwayat.detail', compact('riwayat'));
    }
}
