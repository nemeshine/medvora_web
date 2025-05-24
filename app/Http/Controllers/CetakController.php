<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakController extends Controller
{
    // Halaman daftar pasien dengan pagination & pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pasiens = Pasien::when($search, function ($query, $search) {
                $query->where('nama_pasien', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cetak.index', compact('pasiens', 'search'));
    }

    // Fungsi cetak PDF per pasien
    public function cetak($id)
    {
        $pasien = Pasien::with([
            'alarm.obat',
            'alarm.staff',
            'diagnosa.staff',
        ])->findOrFail($id);

        $pdf = Pdf::loadView('cetak.pasien_pdf', compact('pasien'));
        return $pdf->download('pasien_' . $pasien->nama_pasien . '.pdf');
    }
}
