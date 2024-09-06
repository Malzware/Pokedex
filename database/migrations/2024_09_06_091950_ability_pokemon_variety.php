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
        Schema::create('ability_pokemon_variety', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('ability_id')->constrained('abilities')->onDelete('cascade'); // Clé étrangère vers abilities
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties')->onDelete('cascade'); // Clé étrangère vers pokemon_varieties

            // Index unique pour éviter les doublons
            $table->unique(['ability_id', 'pokemon_variety_id']);

            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ability_pokemon_variety');
    }
};
