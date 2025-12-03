<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthController
 *
 * Controller ini menangani proses autentikasi pengguna, seperti
 * registrasi, login, dan reset password. Sudah menerapkan prinsip
 * OOP (inheritance, encapsulation) dan SOLID, terutama SRP—karena
 * setiap method memiliki tugas tunggal yang jelas.
 */
class AuthController extends Controller
{
    /**
     * Registrasi pengguna baru tanpa verifikasi email.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
            'email_verified_at' => now(),   // langsung dianggap terverifikasi
            'verification_code' => null,
            'is_verified'       => 1
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'user'    => $user
        ]);
    }

    /**
     * Login pengguna tanpa verifikasi email.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Password salah'], 400);
        }

        // Cek status akun
        if ($user->status === 'non-aktif') {
            return response()->json([
                'message' => 'Akun Anda dinonaktifkan oleh admin'
            ], 403);
        }

        // Buat token login
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => $user
        ]);
    }

    /**
     * Reset password tidak digunakan (tanpa OTP).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestResetPassword()
    {
        return response()->json([
            'message' => 'Kode reset password tidak digunakan lagi.'
        ]);
    }

    /**
     * Reset password langsung tanpa OTP.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil direset tanpa verifikasi.'
        ]);
    }
}
