<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Session;


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


        $staff = Staff::where('email', $request->email)->first();


        if ($staff && $staff->password == $request->password) {
            Session::put('id_staff', $staff->id_staff);
            Session::put('nama_staff', $staff->nama_staff);
            Session::put('email', $staff->email);


            return redirect('/dashboard');

        }


        return back()->withErrors(['error' => 'Email atau Password salah'])->withInput();
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
