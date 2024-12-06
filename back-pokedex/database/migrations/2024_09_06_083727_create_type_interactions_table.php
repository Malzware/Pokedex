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
        Schema::create('type_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_type_id')->constrained('types')->onDelete('cascade');
            $table->foreignId('to_type_id')->constrained('types')->onDelete('cascade');
            $table->foreignId('type_interaction_state_id')->constrained('type_interaction_states')->onDelete('cascade');
            $table->timestamps();

            // Index unique pour éviter les doublons
            $table->unique(['from_type_id', 'to_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_interactions');
    }
};
