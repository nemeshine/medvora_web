<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request) {
        
        $query = Pasien::query();

        if ($request->filled('nama')) {
            $query->where('nama_pasien', 'like', '%' . $request->nama . '%');
        }

        $pasiens = $query->paginate(10);
        return view('pasien.index', compact('pasiens'));

    }

    public function create() {
        return view('pasien.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_pasien' => 'required',
            'usia' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required',
            'nomor_hp_keluarga' => 'required',
            'password' => 'required',
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil disimpan.');
    }

    public function show(Pasien $pasien) {
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien) {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien) {
        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien) {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}