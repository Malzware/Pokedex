<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolutionTriggerTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['evolution_trigger_id', 'locale', 'name'];

    // Définition des types de données des attributs
    protected $casts = [
        'evolution_trigger_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
    ];

    /**
     * Relation Many-to-One avec le modèle EvolutionTrigger.
     * Chaque traduction appartient à un déclencheur d'évolution.
     */
    public function evolutionTrigger()
    {
        return $this->belongsTo(EvolutionTrigger::class);
    }
}
