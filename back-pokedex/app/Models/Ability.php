<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ability extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name', 'description', 'effect'];

    // Liste des attributs fillable (mass-assignable)
    protected $fillable = [];

    /**
     * Relation Many-to-Many avec PokemonVariety.
     * Chaque capacité peut être associée à plusieurs variétés de Pokémon via la table ability_pokemon_variety.
     */
    public function varieties()
    {
        return $this->belongsToMany(PokemonVariety::class, 'ability_pokemon_variety')
            ->withPivot('is_hidden', 'slot');
    }
}
