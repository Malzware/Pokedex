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
        Schema::create('pokemon_evolutions', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties')->onDelete('cascade'); // Clé étrangère vers pokemon_varieties
            $table->foreignId('evolves_to_id')->constrained('pokemon_varieties')->onDelete('cascade'); // Clé étrangère vers pokemon_varieties
            $table->boolean('gender')->nullable(); // Genre (nullable)
            $table->foreignId('held_item_id')->nullable()->constrained('items')->onDelete('set null'); // Clé étrangère vers items (nullable)
            $table->foreignId('item_id')->nullable()->constrained('items')->onDelete('set null'); // Clé étrangère vers items (nullable)
            $table->foreignId('known_move_id')->nullable()->constrained('moves')->onDelete('set null'); // Clé étrangère vers moves (nullable)
            $table->foreignId('known_move_type_id')->nullable()->constrained('types')->onDelete('set null'); // Clé étrangère vers types (nullable)
            $table->string('location')->nullable(); // Localisation (nullable)
            $table->integer('min_affection')->nullable(); // Affection minimale (nullable)
            $table->integer('min_happiness')->nullable(); // Bonheur minimal (nullable)
            $table->integer('min_level')->nullable(); // Niveau minimal (nullable)
            $table->boolean('needs_overworld_rain')->default(false); // Pluie nécessaire dans le monde (default false)
            $table->foreignId('party_species_id')->nullable()->constrained('pokemon')->onDelete('set null'); // Clé étrangère vers pokemons (nullable)
            $table->foreignId('party_type_id')->nullable()->constrained('types')->onDelete('set null'); // Clé étrangère vers types (nullable)
            $table->integer('relative_physical_stats')->nullable(); // Statistiques physiques relatives (nullable)
            $table->string('time_of_day')->nullable(); // Heure de la journée (nullable)
            $table->foreignId('trade_species_id')->nullable()->constrained('pokemon')->onDelete('set null'); // Clé étrangère vers pokemons (nullable)
            $table->boolean('turn_upside_down')->default(false); // Inverser (default false)
            $table->foreignId('evolution_trigger_id')->constrained('evolution_triggers')->onDelete('cascade'); // Clé étrangère vers evolution_triggers
            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_evolutions');
    }
};
