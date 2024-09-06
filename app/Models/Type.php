<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Type extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['sprite_url'];

    // Définition des types de données des attributs
    protected $casts = [
        'sprite_url' => 'string',
    ];

    // Définition de la relation many-to-many avec Pokemon
    public function pokemon()
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
