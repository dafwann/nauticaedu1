<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class homeController extends Controller
{
    public function show()
    {
        return Inertia::render('Home');
    }
}
