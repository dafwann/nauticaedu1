<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model User
 *
 * - Mewarisi Authenticatable untuk fitur login/otorisasi
 * - Menggunakan trait: HasApiTokens, HasFactory, Notifiable
 *
 * OOP yang diterapkan:
 * - Inheritance: extends Authenticatable (class turunan dari Model)
 * - Encapsulation: $fillable, $hidden, $casts untuk kontrol atribut
 *
 * SOLID:
 * - Single Responsibility: model hanya menangani representasi data user
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'role',
        'email',
        'status',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
