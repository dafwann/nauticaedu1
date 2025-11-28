<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // List semua user
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    // Ubah status user
    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,non-aktif'
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Status pengguna diperbarui',
            'data' => $user
        ]);
    }
}
