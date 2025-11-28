<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // LIST TANPA BATAS
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $events
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

        $event = Event::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Event berhasil ditambahkan',
            'data' => $event
        ], 201);
    }

    // EDIT DATA (WAJIB SEMUA FIELD)
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
            'status' => true,
            'message' => 'Event berhasil diperbarui',
            'data' => $event
        ]);
    }

    // UBAH STATUS AKTIF / NON-AKTIF
    public function changeStatus(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'status' => 'required|in:aktif,non-aktif'
        ]);

        $event->status = $request->status;
        $event->save();

        return response()->json([
            'status' => true,
            'message' => 'Status event diperbarui',
            'data' => $event
        ]);
    }
}
