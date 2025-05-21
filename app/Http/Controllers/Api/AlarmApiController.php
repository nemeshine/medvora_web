<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alarm;
use Illuminate\Support\Facades\Auth;

class AlarmApiController extends Controller
{
    // GET /api/alarms
    public function index()
    {
        $user = Auth::user(); // pasien yang login via mobile

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

        return response()->json([
            'success' => true,
            'message' => 'Alarm berhasil dikonfirmasi.'
        ]);
    }
}
