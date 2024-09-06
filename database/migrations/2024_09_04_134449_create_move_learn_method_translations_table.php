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
        Schema::create('move_learn_method_translations', function (Blueprint $table) {
            $table->id(); // Clé primaire bigInt auto-incrémentée
            $table->foreignId('move_learn_method_id')->constrained('move_learn_methods')->onDelete('cascade'); // Clé étrangère vers move_learn_methods
            $table->string('locale'); // Locale pour la traduction
            $table->string('name'); // Nom traduit
            $table->text('description')->nullable(); // Description traduite (nullable)

            $table->unique(['move_learn_method_id', 'locale']); // Index unique sur move_learn_method_id et locale
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_learn_method_translations');
    }
};
