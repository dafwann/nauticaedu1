<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model Event
 *
 * - Mewakili tabel "events"
 * - Menggunakan HasFactory untuk pembuatan instance dalam testing/seeding
 *
 * OOP yang diterapkan:
 * - Inheritance: extends Model (Eloquent ORM)
 * - Encapsulation: $fillable menentukan properti yang bisa di-assign massal
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto',
        'link',
        'status'
    ];
}
