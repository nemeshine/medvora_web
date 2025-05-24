<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alarm;
use App\Models\RiwayatAlarm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlarmApiController extends Controller
{
    // GET /api/alarms
    public function index()
    {
        $user = Auth::user(); // pasien yang login via mobile

        // Ambil semua alarm pasien
        $alarms = Alarm::where('id_pasien', $user->id_pasien)->get();

        foreach ($alarms as $alarm) {
            if ($alarm->status === 'aktif') {
                // Gabungkan tanggal dan waktu minum
                $alarmTime = Carbon::parse($alarm->tanggal_mulai . ' ' . $alarm->waktu_minum);

                // Cek jika waktu alarm + 10 menit sudah lewat sekarang
                if (now()->diffInMinutes($alarmTime, false) <= -10) {
                    $alarm->status = 'terlewat';
                    $alarm->save();

                    // Simpan ke riwayat alarm
                    RiwayatAlarm::updateOrCreate(
                        ['id_alarm' => $alarm->id_alarm],
                        [
                            'tanggal' => now()->toDateString(),
                            'waktu_aksi' => now()->toTimeString(),
                            'status' => 'terlewat',
                        ]
                    );
                }
            }
        }

        // Ambil ulang data setelah status diperbarui
        $alarms = Alarm::where('id_pasien', $user->id_pasien)
                       ->orderBy('created_at', 'asc')
                       ->get();

        return response()->json([
            'success' => true,
            'data' => $alarms
        ]);
    }

    // POST /api/alarms/{id}/konfirmasi
    public function konfirmasi($id)
    {
        $user = Auth::user();

        $alarm = Alarm::where('id_alarm', $id)
                      ->where('id_pasien', $user->id_pasien)
                      ->first();

        if (!$alarm) {
            return response()->json([
                'success' => false,
                'message' => 'Alarm tidak ditemukan atau bukan milik Anda.'
            ], 404);
        }

        $alarm->status = 'selesai';
        $alarm->save();

        // Simpan ke riwayat alarm
        RiwayatAlarm::updateOrCreate(
            ['id_alarm' => $alarm->id_alarm],
            [
                'tanggal' => now()->toDateString(),
                'waktu_aksi' => now()->toTimeString(),
                'status' => 'selesai',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Alarm berhasil dikonfirmasi.'
        ]);
    }
}
