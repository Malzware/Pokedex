<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ability_pokemon_variety', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ability_id')->constrained('abilities')->onDelete('cascade');
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties')->onDelete('cascade');
            $table->boolean('is_hidden')->default(false);
            $table->integer('slot');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ability_pokemon_variety');
    }
};