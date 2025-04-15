<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Session;

class StaffAuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('staff.login'); // Mengacu ke resources/views/staff/login.blade.php
    }

    /**
     * Memproses login staff.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Cari staff berdasarkan email pada tabel 'staff'
        $staff = Staff::where('email', $request->email)->first();

        // Verifikasi password secara langsung (plaintext)
        if ($staff && $staff->password == $request->password) {
            // Simpan data staff ke session
            Session::put('id_staff', $staff->id_staff);
            Session::put('nama_staff', $staff->nama_staff);
            Session::put('email', $staff->email);

            // Redirect ke halaman /pasien jika login berhasil
            return redirect('/pasien');
        }

        // Jika email tidak ditemukan atau password salah, kembalikan kembali dengan pesan error
        return back()->withErrors(['error' => 'Email atau Password salah'])->withInput();
    }

    /**
     * Proses logout staff.
     */
    public function logout()
    {
        Session::flush();
        return redirect()->route('staff.login.form');
    }
}
