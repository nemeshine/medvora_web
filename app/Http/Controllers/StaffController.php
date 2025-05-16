<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        
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
            'password'   => $request->password,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'nama_staff' => 'required|string|max:100',
            'email'      => 'required|email|unique:staff,email,' . $id . ',id_staff',
            'password'   => 'nullable|string|min:6',
        ]);

        $staff->nama_staff = $request->nama_staff;
        $staff->email = $request->email;
        if ($request->password) {
            $staff->password = $request->password;
        }
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus.');
    }
}
