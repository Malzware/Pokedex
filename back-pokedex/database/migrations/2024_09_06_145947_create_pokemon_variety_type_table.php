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
        Schema::create('pokemon_variety_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('slot')->check('slot <= 2');
            $table->foreignIdFor(App\Models\PokemonVariety::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\Type::class)->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['pokemon_variety_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_variety_type');
    }
};
