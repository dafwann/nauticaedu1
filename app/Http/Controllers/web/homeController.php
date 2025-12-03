<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Class HomeController
 * 
 * Controller ini bertanggung jawab untuk menampilkan halaman Home
 * menggunakan Inertia. Sudah menerapkan prinsip OOP melalui pewarisan
 * (extends Controller) dan SOLID terutama Single Responsibility Principle,
 * karena hanya mengurus tampilan Home.
 */
class HomeController extends Controller
{
    /**
     * Menampilkan halaman Home.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        return Inertia::render('Home');
    }
}
