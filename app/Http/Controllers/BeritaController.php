<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * USER & ADMIN
     * Ambil hanya 5 berita dengan status published
     */
    public function index()
    {
        $berita = Berita::where('status', 'published')
                        ->latest()
                        ->take(5)
                        ->get();

        return response()->json([
            'status' => true,
            'data' => $berita
        ]);
    }

    /**
     * USER Homepage
     * Reuse fungsi index (SOLID - DRY)
     */
    public function homepage()
    {
        return $this->index();
    }

    /**
     * ADMIN
     * Tambah berita baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        // default status
        $validated['status'] = 'published';

        $berita = Berita::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil ditambahkan',
            'data' => $berita
        ], 201);
    }

    /**
     * ADMIN
     * Update data berita
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
        ]);

        $berita->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil diperbarui',
            'data' => $berita
        ]);
    }

    /**
     * ADMIN
     * Mengubah status berita jadi archived
     */
    public function changeStatus($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->status = 'archived';
        $berita->save();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil diarsipkan',
            'data' => $berita
        ]);
    }

        /**
     * ADMIN
     * Mengubah status berita jadi archived
     */
    public function changeStatus1($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->status = 'published';
        $berita->save();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil dipublikasikan',
            'data' => $berita
        ]);
    }



}
