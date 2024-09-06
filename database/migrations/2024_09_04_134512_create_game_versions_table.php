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
        Schema::create('game_versions', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->string('generic_name'); // Nom générique de la version du jeu
            $table->integer('generation'); // Génération associée à la version du jeu
            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_versions');
    }
};
