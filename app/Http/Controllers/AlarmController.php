<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use App\Models\Pasien;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\RiwayatAlarm;
use Illuminate\Support\Carbon;


class AlarmController extends Controller
{
    public function index()
    {
        $list = Pasien::with('alarm')->withCount([
            'alarm as total_alarm',
            'alarm as total_obat' => fn($q) => $q->selectRaw('SUM(total_obat)'),
            'alarm as alarm_aktif' => fn($q) => $q->where('status', 'aktif'),
            'alarm as alarm_selesai' => fn($q) => $q->where('status', 'selesai'),
        ])->orderByDesc('created_at')
        ->paginate(10);
        
    
        return view('alarm.index', compact('list'));
    }
    

    public function detail($id_pasien)
    {
        $pasien = Pasien::findOrFail($id_pasien);

        $alarms = Alarm::where('id_pasien', $id_pasien)
                       ->with('obat')
                       ->orderByDesc('created_at')
                       ->get();

        return view('alarm.detail', compact('alarms', 'pasien'));
    }

    public function create(Request $request)
    {
        $id_pasien = $request->query('id_pasien');
        $pasien = Pasien::findOrFail($id_pasien); // pastikan id valid
        $obat = Obat::all();
    
        return view('alarm.create', compact('pasien', 'obat'));
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pasien'        => 'required|exists:pasien,id_pasien',
            'id_obat'          => 'required|exists:obat,id_obat',
            'takaran'          => 'required|string',
            'waktu_minum'      => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'instruksi'        => 'required|in:sebelum,sesudah',
            'total_obat'       => 'required|integer|min:1',
        ]);
    
        $data['status'] = 'aktif';
        $data['id_staff'] = Session::get('id_staff');
    
        Alarm::create($data);
    
        return redirect()->route('alarm.index')->with('success', 'Alarm berhasil ditambahkan.');
    }
    

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:aktif,terlewat,selesai'
    ]);

    $alarm = Alarm::findOrFail($id);
    $alarm->status = $request->status;
    $alarm->save();

    // Cek dan catat ke riwayat jika status 'terlewat' atau 'selesai'
    if (in_array($request->status, ['terlewat', 'selesai'])) {
        RiwayatAlarm::updateOrCreate(
            ['id_alarm' => $alarm->id_alarm],
            [
                'tanggal' => now()->toDateString(),
                'waktu_aksi' => now()->toTimeString(),
                'status' => $request->status,
            ]
        );
    }

    return response()->json(['message' => 'Alarm updated']);
}

    
}
