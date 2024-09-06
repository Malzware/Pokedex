<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveLearnMethodTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['move_learn_method_id', 'locale', 'name', 'description'];

    // Définition des types de données des attributs
    protected $casts = [
        'move_learn_method_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
        'description' => 'string',
    ];

    // Relation vers le modèle parent MoveLearnMethod
    public function moveLearnMethod()
    {
        return $this->belongsTo(MoveLearnMethod::class);
    }
}
