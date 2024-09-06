<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeInteraction extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['from_type_id', 'to_type_id', 'type_interaction_state_id'];

    // Définition des relations

    // Type d'où provient l'interaction
    public function fromType()
    {
        return $this->belongsTo(Type::class, 'from_type_id');
    }

    // Type vers lequel l'interaction est dirigée
    public function toType()
    {
        return $this->belongsTo(Type::class, 'to_type_id');
    }

    // État d'interaction entre les types
    public function interactionState()
    {
        return $this->belongsTo(TypeInteractionState::class, 'type_interaction_state_id');
    }
}
