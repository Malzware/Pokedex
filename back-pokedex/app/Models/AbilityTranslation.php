<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbilityTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['ability_id', 'locale', 'name', 'description', 'effect'];

    // Définition des types de données des attributs
    protected $casts = [
        'ability_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
        'description' => 'string',
        'effect' => 'string',
    ];

    /**
     * Relation Many-to-One avec le modèle Ability.
     * Chaque traduction appartient à une capacité (Ability).
     */
    public function ability()
    {
        return $this->belongsTo(Ability::class);
    }
}
