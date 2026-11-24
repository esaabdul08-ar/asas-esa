<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi ke database (Anti MassAssignmentException)
    protected $guarded = ['id'];

    // Relasi: 1 Paket Laundry bisa berada di banyak rincian pesanan (Order Details)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'package_id');
    }
}