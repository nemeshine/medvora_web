<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!session()->has('id_staff')) {
            return redirect('/login'); // tendang ke /
        }

        // Valid entries per page
        $allowedEntries = [10,25,50,100];
        $perPage = in_array((int)$request->entries, $allowedEntries) ? (int)$request->entries : 10;

        // Build base query with ordering by id (newest first)
        $query = Obat::orderBy('id_obat', 'desc');

        // Optional search filtering
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_obat', 'like', "%{$search}%")
                  ->orWhere('dosis', 'like', "%{$search}%")
                  ->orWhere('efek_samping', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        // Paginate with preserved query string
        $obats = $query->paginate($perPage)
                       ->withQueryString();

        return view('obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_obat'    => 'required|string|max:100',
            'dosis'        => 'required|string|max:50',
            'efek_samping' => 'nullable|string|max:255',
            'keterangan'   => 'nullable|string',
        ]);

        Obat::create($data);

        return redirect()->route('obat.index', $request->only('entries','search'))
                         ->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $data = $request->validate([
            'nama_obat'    => 'required|string|max:100',
            'dosis'        => 'required|string|max:50',
            'efek_samping' => 'nullable|string|max:255',
            'keterangan'   => 'nullable|string',
        ]);

        $obat->update($data);

        return redirect()->route('obat.index', $request->only('entries','search'))
                         ->with('success', 'Obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obat.index', $request->only('entries','search'))
                         ->with('success', 'Obat berhasil dihapus.');
    }
}
