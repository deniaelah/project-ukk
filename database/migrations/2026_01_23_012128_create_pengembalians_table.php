<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjamen_id')->constrained('peminjamen')->cascadeOnDelete();
            $table->date('tanggal_kembali');
            $table->integer('jumlah_kembali');
            $table->enum('kondisi_kembali', ['baik','rusak','hilang'])->default('baik');
            $table->decimal('denda', 10, 2)->default(0);
            $table->enum('status_pengembalian', ['tepat waktu','terlambat'])->default('tepat waktu');
            $table->foreignId('diproses_oleh')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
