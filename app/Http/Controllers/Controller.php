<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller Base
 *
 * Semua controller di aplikasi mewarisi class ini.
 * Berisi trait bawaan Laravel untuk:
 * - otorisasi (AuthorizesRequests)
 * - dispatch job (DispatchesJobs)
 * - validasi request (ValidatesRequests)
 *
 * Termasuk implementasi OOP:
 * - Inheritance (class ini mewarisi BaseController)
 * - Trait (mirip multiple inheritance)
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
