<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Move extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name', 'description'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = [
        'accuracy',
        'move_damage_class_id',
        'power',
        'pp',
        'priority',
        'type_id'
    ];

    // Définition des types de données des attributs
    protected $casts = [
        'accuracy' => 'integer',
        'move_damage_class_id' => 'integer',
        'power' => 'integer',
        'pp' => 'integer',
        'priority' => 'integer',
        'type_id' => 'integer',
    ];

    /**
     * Relation Many-to-Many avec PokemonVariety.
     * Un mouvement peut être appris par plusieurs variétés de Pokémon.
     */
    public function varieties()
    {
        return $this->belongsToMany(PokemonVariety::class, 'pokemon_learn_moves')
            ->withPivot('move_learn_method_id', 'game_version_id', 'level');
    }

    /**
     * Relation Many-to-One avec MoveDamageClass.
     * Un mouvement appartient à une seule classe de dégâts.
     */
    public function damageClass()
    {
        return $this->belongsTo(MoveDamageClass::class, 'move_damage_class_id');
    }

    /**
     * Relation Many-to-Many avec MoveLearnMethod.
     * Un mouvement peut être appris par différentes méthodes d'apprentissage.
     */
    public function learnMethods()
    {
        return $this->belongsToMany(MoveLearnMethod::class, 'pokemon_learn_moves')
            ->withPivot('pokemon_variety_id', 'game_version_id', 'level');
    }

    /**
     * Relation Many-to-One avec Type.
     * Un mouvement appartient à un seul type.
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
