<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use Illuminate\Http\Request;

/**
 * Class KomunitasController
 *
 * Controller ini mengelola seluruh proses CRUD untuk data Komunitas.
 * Menggunakan prinsip OOP dengan inheritance (extends Controller)
 * dan menerapkan SOLID secara natural melalui struktur Laravel.
 *
 * - SRP: Tiap method hanya punya satu tanggung jawab.
 * - OCP: Bisa dikembangkan tanpa mengubah struktur inti.
 * - DIP: Menggunakan Eloquent Komunitas (abstraksi ORM).
 */
class KomunitasController extends Controller
{
    /**
     * Mengambil seluruh data komunitas tanpa batasan jumlah.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $komunitas = Komunitas::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data'   => $komunitas
        ]);
    }

    /**
     * Menambahkan komunitas baru.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        // Status default
        $validated['status'] = 'aktif';

        $komunitas = Komunitas::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Komunitas berhasil ditambahkan',
            'data'    => $komunitas
        ], 201);
    }

    /**
     * Menupdate komunitas yang sudah ada.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
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
            'status'  => true,
            'message' => 'Komunitas berhasil diperbarui',
            'data'    => $komunitas
        ]);
    }
}
