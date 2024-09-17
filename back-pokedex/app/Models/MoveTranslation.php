<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveTranslation extends Model
{
    use HasFactory;

    // Pas de timestamps pour ce modèle de traduction
    public $timestamps = false;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['move_id', 'locale', 'name', 'description'];

    // Définition des types de données des attributs
    protected $casts = [
        'move_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
        'description' => 'string',
    ];

    // Relation vers le mouvement parent
    public function move()
    {
        return $this->belongsTo(Move::class, 'move_id');
    }
}
