<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeInteractionState extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['name', 'multiplier'];

    // Définition des types de données des attributs
    protected $casts = [
        'name' => 'string',
        'multiplier' => 'float',
    ];
}
