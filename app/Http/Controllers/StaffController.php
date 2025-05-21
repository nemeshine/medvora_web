<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function index()
    {

                if (!session()->has('id_staff')) {
            return redirect('/login');
        }

        $staffs = Staff::orderBy('created_at', 'desc')->get();
        return view('staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_staff' => 'required|string|max:100',
            'email'      => 'required|email|unique:staff,email',
            'password'   => 'required|string|min:6',
        ]);

Staff::create([
    'nama_staff' => $request->nama_staff,
    'email'      => $request->email,
    'password'   => Hash::make($request->password),
]);


        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function edit($id_staff)
    {
        $staff = Staff::findOrFail($id_staff);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id_staff)
    {
        $staff = Staff::findOrFail($id_staff);

        $request->validate([
            'nama_staff' => 'required|string|max:100',
            'email'      => 'required|email|unique:staff,email,' . $id_staff . ',id_staff',
            'password'   => 'nullable|string|min:6',
        ]);

        $staff->nama_staff = $request->nama_staff;
        $staff->email = $request->email;
if ($request->password) {
    $staff->password = Hash::make($request->password);
}

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy($id_staff)
    {
        $staff = Staff::findOrFail($id_staff);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus.');
    }

    public function verifyPassword(Request $request)
    {
        $id_staff = Session::get('id_staff');

        if (!$id_staff) {
            return redirect('/')->with('error', 'Sesi login tidak ditemukan.');
        }

        $staff = Staff::find($id_staff);

        if (!$staff) {
            return redirect('/')->with('error', 'Data staff tidak ditemukan.');
        }

        if (Hash::check($request->password, $staff->password)) {
            Session::put('verified', true);
            return redirect()->route('staff.index');
        }

        return redirect()->route('staff.index')->with('verify_error', 'Password salah. Coba lagi.');
    }
}
