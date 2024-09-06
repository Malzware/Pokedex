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
        Schema::create('evolution_trigger_translations', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('evolution_trigger_id')->constrained('evolution_triggers')->onDelete('cascade'); // Clé étrangère vers evolution_triggers
            $table->string('locale'); // Locale pour la traduction
            $table->string('name'); // Nom traduit

            $table->unique(['evolution_trigger_id', 'locale']); // Index unique sur evolution_trigger_id et locale
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolution_trigger_translations');
    }
};
