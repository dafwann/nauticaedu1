<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Komunitas
 *
 * - Mewakili tabel "komunitas"
 * - Mengatur atribut yang boleh di-mass assign lewat $fillable
 *
 * OOP yang diterapkan:
 * - Inheritance: extends Model (Eloquent)
 * - Encapsulation: $fillable mengontrol properti yang dapat diisi
 */
class Komunitas extends Model
{
    protected $table = 'komunitas';

    protected $fillable = [
        'nama',
        'foto',
        'link',
        'status'
    ];
}
