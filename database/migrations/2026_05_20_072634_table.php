<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            // Relacja do użytkownika z automatycznym indeksem i kaskadowym usuwaniem
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->string('name');
            $table->string('channel');
            $table->string('target_audience');
            $table->text('brief');
            $table->string('status')->default('draft'); // draft, processing, active, failed
            
            // Kolumna JSON przechowująca strukturę tekstów wygenerowanych przez AI
            $table->json('generated_content')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};