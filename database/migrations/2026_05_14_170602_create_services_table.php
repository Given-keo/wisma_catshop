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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama layanan (misal: Grooming Kutu, Penitipan Harian)
            $table->enum('type', ['grooming', 'boarding']); // Jenis layanan
            $table->text('description')->nullable(); // Penjelasan singkat mengenai layanan
            $table->decimal('price', 10, 2); // Harga layanan
            $table->boolean('is_active')->default(true); // Untuk menonaktifkan layanan jika sedang tidak tersedia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
