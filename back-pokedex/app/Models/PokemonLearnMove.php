<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLearnMove extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = [
        'pokemon_variety_id',
        'move_id',
        'move_learn_method_id',
        'game_version_id',
        'level'
    ];

    // Définition des types de données des attributs
    protected $casts = [
        'pokemon_variety_id' => 'integer',
        'move_id' => 'integer',
        'move_learn_method_id' => 'integer',
        'game_version_id' => 'integer',
        'level' => 'integer',
    ];

    // Relation vers la variété de Pokémon
    public function pokemonVariety()
    {
        return $this->belongsTo(PokemonVariety::class, 'pokemon_variety_id'); // Ajout de la clé étrangère pour plus de clarté
    }

    // Relation vers le mouvement
    public function move()
    {
        return $this->belongsTo(Move::class, 'move_id'); // Ajout de la clé étrangère pour plus de clarté
    }

    // Relation vers la méthode d'apprentissage du mouvement
    public function moveLearnMethod()
    {
        return $this->belongsTo(MoveLearnMethod::class, 'move_learn_method_id'); // Ajout de la clé étrangère pour plus de clarté
    }

    // Relation vers la version du jeu
    public function gameVersion()
    {
        return $this->belongsTo(GameVersion::class, 'game_version_id'); // Ajout de la clé étrangère pour plus de clarté
    }
}
