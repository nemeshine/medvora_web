<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\staff;
use Illuminate\Support\Facades\Session;

class auth_controller extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $staff = staff::where('email', $request->email)->first();

        if ($staff && $staff->password === $request->password) {
            Session::put('staff', $staff->id_staff);
            return redirect('/pasien');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout() {
        Session::forget('staff');
        return redirect('/login');
    }
}
