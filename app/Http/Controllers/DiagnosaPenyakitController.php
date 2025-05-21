<?php

namespace App\Http\Controllers;
use App\Models\DiagnosaPenyakit;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiagnosaPenyakitController extends Controller
{
    public function index(Request $r)
    {

        if (!session()->has('id_staff')) {
            return redirect('/login');
        }

        $perPage = $r->entries ?? 10;
        $q = DiagnosaPenyakit::with(['pasien','staff'])
             ->orderBy('id_diagnosa','desc');

if ($r->filled('search')) {
    $s = $r->search;
    $q->where(function($query) use ($s) {
        $query->where('keluhan', 'like', "%{$s}%")
              ->orWhere('diagnosa', 'like', "%{$s}%")
              ->orWhereHas('pasien', function($q2) use ($s) {
                  $q2->where('nama_pasien', 'like', "%{$s}%");
              });
    });
}


        $list = $q->paginate($perPage)->withQueryString();
        return view('diagnosa.index',compact('list'));
    }

    public function create()
    {
        $pasiens = Pasien::orderBy('nama_pasien')->get();
        return view('diagnosa.create',compact('pasiens'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'id_pasien'        =>'required|exists:pasien,id_pasien',
            'tanggal_keluhan'  =>'required|date',
            'keluhan'          =>'required|string',
            'tanggal_diagnosa' =>'required|date',
            'diagnosa'         =>'required|string|max:255',
            'resep_obat'       =>'nullable|string',
            'catatan_tambahan' =>'nullable|string',
        ]);
        // set dokter dari session
        $data['id_staff'] = Session::get('id_staff');
        DiagnosaPenyakit::create($data);
        return redirect()->route('diagnosa.index')
                         ->with('success','Diagnosa ditambahkan');
    }

    public function edit(DiagnosaPenyakit $diagnosa)
    {
        $pasiens = Pasien::orderBy('nama_pasien')->get();
        return view('diagnosa.edit',compact('diagnosa','pasiens'));
    }

    public function update(Request $r, DiagnosaPenyakit $diagnosa)
    {
        $data = $r->validate([
            'id_pasien'        =>'required|exists:pasien,id_pasien',
            'tanggal_keluhan'  =>'required|date',
            'keluhan'          =>'required|string',
            'tanggal_diagnosa' =>'required|date',
            'diagnosa'         =>'required|string|max:255',
            'resep_obat'       =>'nullable|string',
            'catatan_tambahan' =>'nullable|string',
        ]);
        // jaga id_staff tetap sama
        $data['id_staff'] = $diagnosa->id_staff;
        $diagnosa->update($data);
        return redirect()->route('diagnosa.index')
                         ->with('success','Diagnosa diperbarui');
    }

    public function destroy(DiagnosaPenyakit $diagnosa)
    {
        $diagnosa->delete();
        return redirect()->route('diagnosa.index')
                         ->with('success','Diagnosa dihapus');
    }
}
