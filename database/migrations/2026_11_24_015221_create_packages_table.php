<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Nama Paket (Cuci Komplit Reguler, Cuci Express, Bed Cover)
            $table->integer('price');               // Tarif Harga per Kg / Satuan
            $table->integer('stock');               // Kuota / Kapasitas Mesin Cuci Harian (Kg atau Pcs)
            $table->text('description');           // Rincian Fasilitas (Deterjen Premium, Setrika Uap, dll)
            $table->string('estimate')->nullable(); // Estimasi Pengerjaan (misal: '2 Hari', '1 Hari', '4 Jam')
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};