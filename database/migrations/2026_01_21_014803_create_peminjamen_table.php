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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('alat_id')->constrained('alats')->cascadeOnDelete();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_rencana_kembali');
            $table->integer('jumlah_pinjam');
            $table->enum('status_peminjaman', ['menunggu','disetujui','ditolak','dipinjam'])->default('menunggu');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
