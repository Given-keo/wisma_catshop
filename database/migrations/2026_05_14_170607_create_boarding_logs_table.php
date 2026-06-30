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
            $table->string('eating_condition'); 
            $table->string('activity');    
            $table->string('photo_path')->nullable();
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
