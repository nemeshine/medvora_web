<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('staff.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Ambil data staff berdasarkan email
        $staff = Staff::where('email', $request->email)->first();

        // Cek apakah staff ditemukan dan password cocok
            if ($staff && Hash::check($request->password, $staff->password)) {
            Session::put('id_staff', $staff->id_staff);
            Session::put('nama_staff', $staff->nama_staff);
            Session::put('email', $staff->email);
            Session::put('verified', false);

            return redirect('/dashboard');
        }

        return back()->withErrors(['error' => 'Email atau Password salah'])->withInput();
    }

    public function logout()
    {
        Session::flush(); // Hapus semua session
        return redirect('/'); // Arahkan ke halaman utama/login
    }
}
