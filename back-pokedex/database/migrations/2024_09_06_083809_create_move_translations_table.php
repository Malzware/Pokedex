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
        Schema::create('move_translations', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('move_id')->constrained('moves')->onDelete('cascade'); // Clé étrangère vers moves
            $table->string('locale'); // Locale pour la traduction
            $table->string('name'); // Nom traduit
            $table->string('description')->nullable(); // Description traduite (peut être nulle)

            // Index unique pour (move_id, locale)
            $table->unique(['move_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_translations');
    }
};
