<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    // LIST TANPA BATAS
    public function index()
    {
        $komunitas = Komunitas::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $komunitas
        ]);
    }

    // TAMBAH DATA
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        $validated['status'] = 'aktif';

        $komunitas = Komunitas::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Komunitas berhasil ditambahkan',
            'data' => $komunitas
        ], 201);
    }

    // EDIT DATA
    public function update(Request $request, $id)
    {
        $komunitas = Komunitas::findOrFail($id);

        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'foto'   => 'required|string|max:255',
            'link'   => 'required|string|max:255',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $komunitas->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Komunitas berhasil diperbarui',
            'data' => $komunitas
        ]);
    }

}
