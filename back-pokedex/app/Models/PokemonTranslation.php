<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonTranslation extends Model
{
    use HasFactory;

    // Pas de timestamps pour ce modèle de traduction
    public $timestamps = false;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['pokemon_id', 'locale', 'name', 'category'];

    // Définition des types de données des attributs
    protected $casts = [
        'pokemon_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
        'category' => 'string',
    ];

    // Relation vers le modèle parent Pokemon
    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
