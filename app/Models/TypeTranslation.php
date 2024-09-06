<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['type_id', 'locale', 'name'];

    // Définition de la relation vers le modèle parent Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
