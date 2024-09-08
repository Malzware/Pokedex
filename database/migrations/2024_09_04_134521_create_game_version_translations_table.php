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
        Schema::create('game_version_translations', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('game_version_id')->constrained('game_versions')->onDelete('cascade'); // Clé étrangère vers game_versions
            $table->string('locale'); // Locale pour la traduction
            $table->string('name'); // Nom traduit
            $table->timestamps(); // Pour les colonnes created_at et updated_at
            $table->unique(['game_version_id', 'locale']); // Index unique sur game_version_id et locale
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_version_translations');
    }
};
