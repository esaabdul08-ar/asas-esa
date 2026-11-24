<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: 1 Pesanan dimiliki oleh 1 Pengguna (Pelanggan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: 1 Pesanan memiliki banyak rincian paket laundry yang dicuci (Order Details)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}