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
        Schema::create('pokemon_variety_type', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties')->onDelete('cascade'); // Clé étrangère vers pokemon_varieties
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade'); // Clé étrangère vers types

            // Index unique pour éviter les doublons
            $table->unique(['pokemon_variety_id', 'type_id']);

            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_variety_type');
    }
};
