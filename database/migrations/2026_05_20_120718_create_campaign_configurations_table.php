<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->text('product_description');
            $table->text('target_audience');
            $table->string('campaign_goal');
            $table->string('tone_of_voice');
            $table->string('main_cta');
            $table->string('geo_scope');
            $table->string('geo_details')->nullable();
            $table->json('channels'); // Przechowywanie wielu platform (np. Facebook, TikTok)
            $table->text('exclusions')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('budget')->nullable();
            $table->string('output_structure')->nullable(); // Opcjonalna struktura oczekiwanego outputu od AI
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_configurations');
    }
};