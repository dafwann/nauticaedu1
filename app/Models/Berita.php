<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Berita
 *
 * - Mewakili tabel "beritas"
 * - Menggunakan HasFactory untuk kebutuhan seeding/testing
 *
 * OOP yang diterapkan:
 * - Inheritance: extends Model (Eloquent ORM)
 * - Encapsulation: $fillable membatasi atribut yang dapat diisi massal
 */
class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'link',
        'foto',
    ];
}
