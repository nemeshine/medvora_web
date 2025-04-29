<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        if (!session()->has('id_staff')) {
            return redirect('/login'); // tendang ke /
        }

        $totalPengguna = Pasien::count();

        $search = $request->search;
        $penggunaBaru = Pasien::orderBy('created_at', 'desc');

        if ($search) {
            $penggunaBaru->where('nama_pasien', 'like', "%$search%")
                         ->orWhere('nik', 'like', "%$search%");
        }

        $penggunaBaru = $penggunaBaru->paginate(3)->withQueryString();

        return view('dashboard', compact('totalPengguna', 'penggunaBaru', 'search'));
    }
}
