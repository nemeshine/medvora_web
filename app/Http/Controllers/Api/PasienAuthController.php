<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;

class PasienAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $pasien = Pasien::where('email', $request->email)->first();

        if (!$pasien || $request->password !== $pasien->password) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }        

        $token = $pasien->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'pasien'  => $pasien
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}

