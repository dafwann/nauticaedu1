<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register - tanpa verifikasi email
     */
    public function register(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'email'             => $request->email,
            'username'          => $request->username,
            'password'          => Hash::make($request->password),
            'role'              => 'user',
            'status'            => 'aktif',
            'email_verified_at' => now(),        // auto verified
            'verification_code' => null,         // tidak dipakai lagi
            'is_verified'       => 1
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'user' => $user
        ]);
    }

    /**
     * Login - tanpa cek email verified
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user)
            return response()->json(['message' => 'Email tidak ditemukan'], 404);

        if (!Hash::check($request->password, $user->password))
            return response()->json(['message' => 'Password salah'], 400);

        // Cek status akun (optional)
        if ($user->status === 'non-aktif') {
            return response()->json([
                'message' => 'Akun Anda dinonaktifkan oleh admin'
            ], 403);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => $user
        ]);
    }

    /**
     * Reset Password - tanpa OTP
     */
    public function requestResetPassword(Request $request)
    {
        return response()->json([
            'message' => 'Kode reset password tidak digunakan lagi.'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user)
            return response()->json(['message' => 'Email tidak ditemukan'], 404);

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password berhasil direset tanpa verifikasi.']);
    }
}
