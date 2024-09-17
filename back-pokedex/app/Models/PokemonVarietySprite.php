<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonVarietySprite extends Model
{
  use HasFactory;

  // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
  protected $fillable = [
    'artwork_url',
    'artwork_shiny_url',
    'front_url',
    'front_female_url',
    'front_shiny_url',
    'front_shiny_female_url',
    'back_url',
    'back_female_url',
    'back_shiny_url',
    'back_shiny_female_url'
  ];

  // Relation avec le modèle `PokemonVariety`
  public function variety()
  {
    return $this->belongsTo(PokemonVariety::class);
  }
}
