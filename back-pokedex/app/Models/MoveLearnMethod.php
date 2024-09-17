<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MoveLearnMethod extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name', 'description'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = [];

    // Définition des relations avec d'autres modèles si nécessaire
    /**
     * Relation One-to-Many avec MoveLearnMethodTranslation.
     * Une méthode d'apprentissage peut avoir plusieurs traductions.
     */
    public function moveLearnMethodTranslations()
    {
        return $this->hasMany(MoveLearnMethodTranslation::class);
    }
}
