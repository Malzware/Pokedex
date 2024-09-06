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
        Schema::create('moves', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->integer('accuracy')->nullable(); // Précision du mouvement
            $table->foreignId('move_damage_class_id')->constrained('move_damage_classes')->onDelete('cascade'); // Clé étrangère vers move_damage_classes
            $table->integer('power')->nullable(); // Puissance du mouvement
            $table->integer('pp'); // Points de pouvoir du mouvement
            $table->integer('priority'); // Priorité du mouvement
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade'); // Clé étrangère vers types
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};
