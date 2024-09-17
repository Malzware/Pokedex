<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class PokemonVariety extends Model implements TranslatableContract
{
  use HasFactory, Translatable;

  // Liste des attributs traduits
  public $translatedAttributes = ['name', 'description', 'form_name'];

  // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
  protected $fillable = [
    'pokemon_id',
    'is_default',
    'cry_url',
    'height',
    'weight',
    'base_experience',
    'base_stats_hp',
    'base_stats_attack',
    'base_stats_defense',
    'base_stats_special_attack',
    'base_stats_special_defense',
    'base_stats_speed'
  ];

  // Définition des types de données des attributs
  protected $casts = [
    'is_default' => 'boolean',
  ];

  // Relation avec le modèle `Pokemon`
  public function pokemon()
  {
    return $this->belongsTo(Pokemon::class);
  }

  // Relation avec le modèle `PokemonVarietySprite`
  public function sprites()
  {
    return $this->hasOne(PokemonVarietySprite::class);
  }

  // Relation avec le modèle `Type` via la table de pivot `pokemon_variety_type`
  public function types()
  {
    return $this->belongsToMany(Type::class, 'pokemon_variety_type')
      ->withPivot('slot');
  }

  // Relation avec le modèle `Ability` via la table de pivot `ability_pokemon_variety`
  public function abilities()
  {
    return $this->belongsToMany(Ability::class, 'ability_pokemon_variety')
      ->withPivot('is_hidden', 'slot');
  }

  // Relation avec le modèle `Move` via la table de pivot `pokemon_learn_moves`
  public function moves()
  {
    return $this->belongsToMany(Move::class, 'pokemon_learn_moves')
      ->withPivot('move_learn_method_id', 'game_version_id', 'level');
  }

  public function learnedMoves()
  {
    return $this->hasMany(PokemonLearnMove::class, 'pokemon_variety_id');
  }

  public function evolutions()
  {
    return $this->hasMany(PokemonEvolution::class, 'pokemon_variety_id');
  }

  public function evolvesTo()
{
    return $this->belongsTo(PokemonVariety::class, 'evolves_to_id');
}
}
