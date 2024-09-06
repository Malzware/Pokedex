<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersionTranslation extends Model
{
    use HasFactory;

    // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
    protected $fillable = ['game_version_id', 'locale', 'name'];

    // Définition des types de données des attributs
    protected $casts = [
        'game_version_id' => 'integer',
        'locale' => 'string',
        'name' => 'string',
    ];

    // Relation vers le modèle parent GameVersion
    public function gameVersion()
    {
        return $this->belongsTo(GameVersion::class);
    }
}
