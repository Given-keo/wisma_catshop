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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique(); // Ini untuk "NO." di pojok kanan atas form
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cat_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            
            $table->date('start_date'); // TITIP TANGGAL
            $table->date('end_date')->nullable(); // AMBIL TANGGAL
            
            $table->decimal('total_price', 10, 2);
            $table->decimal('down_payment', 10, 2)->default(0); // TAMBAHAN: Untuk catat Uang Muka
            $table->string('payment_proof')->nullable(); 
            
            $table->text('brought_items')->nullable(); // TAMBAHAN: Catatan bawa Pet Cargo / Pakan sendiri
            
            // Status disesuaikan dengan alur DP
            $table->enum('status', [
                'pending_payment',      
                'waiting_confirmation', 
                'dp_paid',              // TAMBAHAN: Status jika baru bayar Uang Muka 50%
                'fully_paid',           // Lunas
                'completed',            
                'cancelled'             
            ])->default('pending_payment');
            
            $table->boolean('is_walk_in')->default(false);
            $table->boolean('is_reward_claimed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
