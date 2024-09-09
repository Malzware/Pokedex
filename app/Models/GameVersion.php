<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class GameVersion extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['generic_name', 'generation'];

    // Définition des types de données des attributs
    protected $casts = [
        'generation' => 'integer',
    ];

    /**
     * Relation One-to-Many avec GameVersionTranslation.
     * Une version de jeu peut avoir plusieurs traductions.
     */
    public function gameVersionTranslations()
    {
        return $this->hasMany(GameVersionTranslation::class);
    }

    /**
     * Relation One-to-Many avec PokemonLearnMove.
     * Une version de jeu peut être liée à plusieurs mouvements appris par les Pokémon.
     */
    public function pokemonLearnMoves()
    {
        return $this->hasMany(PokemonLearnMove::class);
    }
}
