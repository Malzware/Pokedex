<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MoveDamageClass extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name', 'description'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['name', 'description'];

    // Définition des relations avec d'autres modèles si nécessaire
    /**
     * Relation One-to-Many avec Move.
     * Une classe de dégâts peut être associée à plusieurs mouvements.
     */
    public function moves()
    {
        return $this->hasMany(Move::class, 'move_damage_class_id');
    }
}
