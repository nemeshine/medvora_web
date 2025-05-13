<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Alarm;
use App\Models\RiwayatAlarm;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Cek login staff
        if (!session()->has('id_staff')) {
            return redirect('/login');
        }

        // Hitung total pengguna
        $totalPengguna = Pasien::count();

        // Handle search pengguna baru
        $search = $request->search;
        $penggunaBaru = Pasien::orderBy('created_at', 'desc');

        if ($search) {
            $penggunaBaru->where('nama_pasien', 'like', "%$search%")
                         ->orWhere('nik', 'like', "%$search%");
        }

        $penggunaBaru = $penggunaBaru->paginate(3)->withQueryString();

        // Statistik alarm
        $alarmAktif = Alarm::where('status', 'aktif')->count();
        $alarmTerlewat = RiwayatAlarm::where('status', 'terlewat')->count();
        $alarmSelesai = RiwayatAlarm::where('status', 'selesai')->count();

        // Data chart per bulan (Januari - Desember)
        $chartData = [
            'labels' => [],
            'aktif' => [],
            'terlewat' => [],
            'selesai' => []
        ];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('M');
            $chartData['labels'][] = $monthName;

            $chartData['aktif'][] = Alarm::whereMonth('created_at', $i)
                                         ->whereYear('created_at', now()->year)
                                         ->where('status', 'aktif')->count();

            $chartData['terlewat'][] = RiwayatAlarm::whereMonth('tanggal', $i)
                                                   ->whereYear('tanggal', now()->year)
                                                   ->where('status', 'terlewat')->count();

            $chartData['selesai'][] = RiwayatAlarm::whereMonth('tanggal', $i)
                                                  ->whereYear('tanggal', now()->year)
                                                  ->where('status', 'selesai')->count();
        }

        return view('dashboard', compact(
            'totalPengguna',
            'penggunaBaru',
            'search',
            'alarmAktif',
            'alarmTerlewat',
            'alarmSelesai',
            'chartData'
        ));
    }
}
