<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Type extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['sprite_url'];

    // Définition des types de données des attributs
    protected $casts = [
        'sprite_url' => 'string',
    ];

    // Relation avec les variétés de Pokémon
    public function varieties()
    {
        return $this->belongsToMany(PokemonVariety::class, 'pokemon_variety_type')
            ->withPivot('slot');
    }
}
