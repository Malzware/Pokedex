<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['item_id', 'locale', 'name', 'description'];

    // Définition des types de données des attributs
    protected $casts = [
        'item_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
        'description' => 'string',
    ];

    // Relation vers l'item parent
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
