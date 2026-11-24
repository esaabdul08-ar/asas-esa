<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Baris rincian ini merujuk ke data paket laundry mana
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    // Relasi: Baris rincian ini terhubung ke transaksi pesanan order mana
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}