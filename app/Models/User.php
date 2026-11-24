<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Fungsi cek apakah akun ini Admin Laundry
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Fungsi cek apakah akun ini Kasir Laundry
    public function isKasir(): bool
    {
        return $this->role === 'kasir';
    }

    // Relasi: 1 User bisa punya banyak transaksi pesanan laundry
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
