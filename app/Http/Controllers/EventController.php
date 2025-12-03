<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class EventController
 *
 * Controller ini menangani seluruh proses CRUD dan perubahan status
 * untuk data Event. Controller ini sudah mengikuti prinsip OOP melalui
 * konsep inheritance (extends Controller) dan menerapkan SOLID terutama:
 *
 * - SRP: Setiap method memiliki satu tanggung jawab.
 * - OCP: Mudah dikembangkan tanpa perlu mengubah struktur yang sudah ada.
 * - DIP: Menggunakan model Event (abstraksi Laravel ORM) tanpa membuat
 *        instance manual.
 */
class EventController extends Controller
{
    /**
     * Mengambil seluruh event yang tersedia (tanpa pagination).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data'   => $events
        ]);
    }

    /**
     * Menambah event baru.
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

        // Default status event
        $validated['status'] = 'aktif';

        $event = Event::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Event berhasil ditambahkan',
            'data'    => $event
        ], 201);
    }

    /**
     * Update data event yang sudah ada (semua field wajib).
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'foto'   => 'required|string|max:255',
            'link'   => 'required|string|max:255',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $event->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Event berhasil diperbarui',
            'data'    => $event
        ]);
    }

    /**
     * Mengubah status event menjadi aktif atau non-aktif.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'status' => 'required|in:aktif,non-aktif'
        ]);

        $event->status = $request->status;
        $event->save();

        return response()->json([
            'status'  => true,
            'message' => 'Status event diperbarui',
            'data'    => $event
        ]);
    }
}
