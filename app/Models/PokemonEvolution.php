<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonEvolution extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = [
        'pokemon_variety_id',
        'evolves_to_id',
        'gender',
        'held_item_id',
        'item_id',
        'known_move_id',
        'known_move_type_id',
        'location',
        'min_affection',
        'min_happiness',
        'min_level',
        'need_overworld_rain',
        'party_species_id',
        'party_type_id',
        'relative_physical_stats',
        'time_of_day',
        'trade_species_id',
        'turn_upside_down',
        'evolution_trigger_id'
    ];

    // Définition des types de données des attributs
    protected $casts = [
        'gender' => 'boolean',
        'need_overworld_rain' => 'boolean',
        'relative_physical_stats' => 'integer',
        'turn_upside_down' => 'boolean',
    ];

    // Relation vers Pokémon variété (Pokémon de départ)
    public function pokemonVariety()
    {
        return $this->belongsTo(PokemonVariety::class, 'pokemon_variety_id');
    }

    // Relation vers la variété vers laquelle le Pokémon évolue
    public function evolvesTo()
    {
        return $this->belongsTo(PokemonVariety::class, 'evolves_to_id');
    }

    // Relation vers les objets tenus
    public function heldItem()
    {
        return $this->belongsTo(Item::class, 'held_item_id');
    }

    // Relation vers les objets
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    // Relation vers les mouvements connus
    public function knowMove()
    {
        return $this->belongsTo(Move::class, 'know_move_id');
    }

    // Relation vers le type du mouvement connu
    public function knowMoveType()
    {
        return $this->belongsTo(Type::class, 'know_move_type_id');
    }

    // Relation vers le type de l'équipe
    public function partyType()
    {
        return $this->belongsTo(Type::class, 'party_type_id');
    }

    // Relation vers le Pokémon pour la condition de l'équipe
    public function partySpecies()
    {
        return $this->belongsTo(Pokemon::class, 'party_species_id');
    }

    // Relation vers le Pokémon pour la condition de l'échange
    public function tradeSpecies()
    {
        return $this->belongsTo(Pokemon::class, 'trade_species_id');
    }

    // Relation vers le déclencheur d'évolution
    public function evolutionTrigger()
    {
        return $this->belongsTo(EvolutionTrigger::class, 'evolution_trigger_id');
    }
}

