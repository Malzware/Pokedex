<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveDamageClassTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['move_damage_class_id', 'locale', 'name', 'description'];

    // Définition des types de données des attributs
    protected $casts = [
        'move_damage_class_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
        'description' => 'string',
    ];

    /**
     * Relation Many-to-One avec MoveDamageClass.
     * Chaque traduction appartient à une seule classe de dégâts.
     */
    public function moveDamageClass()
    {
        return $this->belongsTo(MoveDamageClass::class);
    }
}
