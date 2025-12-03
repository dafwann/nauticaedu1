<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class AdminUserController
 *
 * Controller ini menangani manajemen data pengguna oleh admin,
 * seperti melihat daftar user dan mengubah status user.
 * Sudah menerapkan prinsip OOP (inheritance) dan SOLID, khususnya
 * SRP karena setiap method memiliki satu tanggung jawab yang jelas.
 */
class AdminUserController extends Controller
{
    /**
     * Mengambil daftar seluruh user untuk admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data'   => $users
        ]);
    }

    /**
     * Mengubah status pengguna berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, $id)
    {
        // Validasi input status (aktif / non-aktif)
        $request->validate([
            'status' => 'required|in:aktif,non-aktif'
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'Status pengguna diperbarui',
            'data'    => $user
        ]);
    }
}
