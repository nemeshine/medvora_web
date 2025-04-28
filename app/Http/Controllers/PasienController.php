<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query();

        if (!session()->has('id_staff')) {
            return redirect('/login');
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('nama_pasien', 'like', "%{$s}%")
                  ->orWhere('nik', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        $perPage = $request->entries ?? 10;
        $pasiens = $query->orderBy('created_at', 'desc')
                         ->paginate($perPage)
                         ->withQueryString();

        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik'               => 'required|string|unique:pasien,nik',
            'nama_pasien'       => 'required|string|max:100',
            'email'             => 'required|email|unique:pasien,email',
            'tanggal_lahir'     => 'required|date',
            'jenis_kelamin'     => 'required|in:L,P',
            'nomor_hp'          => 'required|string|max:20',
            'nomor_hp_keluarga' => 'required|string|max:20',
            'riwayat_penyakit'  => 'nullable|string',
            'password'          => 'required|string|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        Pasien::create($data);

        return redirect()->route('pasien.index')
                         ->with('success', 'Data pasien berhasil disimpan.');
    }

    public function show(Pasien $pasien)
    {
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $data = $request->validate([
            'nik'               => 'required|string|unique:pasien,nik,' . $pasien->id_pasien . ',id_pasien',
            'nama_pasien'       => 'required|string|max:100',
            'email'             => 'required|email|unique:pasien,email,' . $pasien->id_pasien . ',id_pasien',
            'tanggal_lahir'     => 'required|date',
            'jenis_kelamin'     => 'required|in:L,P',
            'nomor_hp'          => 'required|string|max:20',
            'nomor_hp_keluarga' => 'required|string|max:20',
            'riwayat_penyakit'  => 'nullable|string',
            'password'          => 'nullable|string|min:6',
        ]);

        // Jika password baru diisi, hash, jika tidak hapus dari data
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $pasien->update($data);

        return redirect()->route('pasien.index')
                         ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')
                         ->with('success', 'Data pasien berhasil dihapus.');
    }
}
