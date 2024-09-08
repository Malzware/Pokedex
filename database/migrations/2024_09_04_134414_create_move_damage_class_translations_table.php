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
        Schema::create('move_damage_class_translations', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->foreignId('move_damage_class_id')->constrained('move_damage_classes')->onDelete('cascade');
            $table->string('locale');
            $table->string('name');
            $table->string('description')->nullable(); // Le champ description peut être nul
            $table->timestamps();

            // Index unique sur la combinaison (move_damage_class_id, locale)
            $table->unique(['move_damage_class_id', 'locale'], 'move_damage_class_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_damage_class_translations');
    }
};
