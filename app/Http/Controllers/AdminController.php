<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Event;
use App\Models\Komunitas;

/**
 * Class AdminController
 *
 * Controller ini bertanggung jawab untuk menyediakan data statistik
 * bagi dashboard admin. Controller ini sudah mengikuti prinsip OOP
 * melalui inheritance (extends Controller), dan menerapkan SOLID
 * terutama Single Responsibility Principle karena hanya menangani
 * pengambilan data statistik.
 */
class AdminController extends Controller
{
    /**
     * Mengambil data statistik untuk ditampilkan pada dashboard admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        return response()->json([
            'totalUsers'        => User::count(),
            'totalNews'         => Berita::count(),
            'totalCommunities'  => Komunitas::count(),
            'totalVolunteers'   => Event::count()
        ]);
    }
}

