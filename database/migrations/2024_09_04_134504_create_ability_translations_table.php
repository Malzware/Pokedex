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
        Schema::create('ability_translations', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('ability_id')->constrained('abilities')->onDelete('cascade'); // Clé étrangère vers abilities
            $table->string('locale'); // Locale pour la traduction
            $table->string('name'); // Nom traduit
            $table->text('description')->nullable(); // Description traduite (nullable)
            $table->text('effect')->nullable(); // Effet traduit (nullable)

            $table->unique(['ability_id', 'locale']); // Index unique sur ability_id et locale
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ability_translations');
    }
};
