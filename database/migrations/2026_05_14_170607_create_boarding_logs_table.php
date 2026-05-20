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
        Schema::create('boarding_logs', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel bookings (transaksi penitipannya)
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            
            // Tanggal log dicatat
            $table->date('log_date');
            
            // Kondisi harian
            $table->string('eating_condition'); // Misal: "Makan Lahap", "Makan Sedikit", "Tidak Makan"
            $table->string('activity');         // Misal: "Aktif Bermain", "Tidur Terus", "Gelisah"
            
            // Catatan tambahan jika ada indikasi sakit/lainnya
            $table->text('health_notes')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_logs');
    }
};
