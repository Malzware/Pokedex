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
    
    // Définition des relations avec d'autres modèles si nécessaire
    public function moveLearnMethodTranslations()
    {
        return $this->hasMany(MoveLearnMethodTranslation::class);
    }
}
