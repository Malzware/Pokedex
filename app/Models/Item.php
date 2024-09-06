<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Item extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Liste des attributs traduits
    public $translatedAttributes = ['name', 'description'];

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['sprite_url'];

    // Définition des types de données des attributs
    protected $casts = [
        'sprite_url' => 'string',
    ];
}