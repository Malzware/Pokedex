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
        Schema::create('pokemon_learn_moves', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties')->onDelete('cascade'); // Clé étrangère vers pokemon_varieties
            $table->foreignId('move_id')->constrained('moves')->onDelete('cascade'); // Clé étrangère vers moves
            $table->foreignId('move_learn_method_id')->constrained('move_learn_methods')->onDelete('cascade'); // Clé étrangère vers move_learn_methods
            $table->foreignId('game_version_id')->constrained('game_versions')->onDelete('cascade'); // Clé étrangère vers game_versions
            $table->integer('level')->default(0); // Niveau du mouvement

            // Index unique pour éviter les doublons
            $table->unique([
                'pokemon_variety_id',
                'move_id',
                'move_learn_method_id',
                'game_version_id'
            ]);

            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_learn_moves');
    }
};
