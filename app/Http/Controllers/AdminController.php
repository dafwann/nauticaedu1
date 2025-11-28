<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Event;
use App\Models\Komunitas;

class AdminController extends Controller
{
    public function getStats()
    {
        return response()->json([
            'totalUsers' => User::count(),
            'totalNews' => Berita::count(),
            'totalCommunities' => Komunitas::count(),
            'totalVolunteers' => Event::count()
        ]);
    }
}
