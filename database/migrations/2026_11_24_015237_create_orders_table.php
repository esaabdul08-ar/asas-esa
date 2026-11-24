<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Akun Pelanggan jika login
            $table->string('customer_name')->nullable();  // Nama Pelanggan yang Mengantar Cucian
            $table->string('customer_phone')->nullable(); // Nomor WhatsApp / HP Pelanggan
            $table->string('order_code')->unique();       // Kode Unik Transaksi Laundry (contoh: LND-20261111-XXXX)
            $table->integer('total_price');               // Total Biaya Cucian
            $table->string('status')->default('Pending'); // Status: Pending / Proses / Selesai / Batal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};