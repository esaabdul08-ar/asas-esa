<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');     // Hubungkan ke Header Order
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade'); // Hubungkan ke Master Paket Laundry
            $table->integer('quantity');  // Jumlah Berat (Kg) atau Jumlah Pcs cucian
            $table->integer('price');     // Tarif satuan saat pesanan dibuat
            $table->integer('subtotal');  // Hasil kali: quantity x price
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};