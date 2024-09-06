<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ability extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name', 'description', 'effect'];

    // Définition des relations avec d'autres modèles si nécessaire
    public function abilityTranslations()
    {
        return $this->hasMany(AbilityTranslation::class);
    }
}
