<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('breed')->nullable(); 
            $table->enum('gender', ['Jantan', 'Betina'])->nullable();
            $table->string('age')->nullable();
            $table->string('color')->nullable(); 
            $table->string('photo')->nullable(); 
            $table->text('health_notes')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};