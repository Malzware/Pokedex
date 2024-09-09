<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonVarietyTranslation extends Model
{
  use HasFactory;

  // Liste des attributs autorisés pour la création et la mise à jour des données de manière massive
  protected $fillable = ['name', 'description', 'form_name'];
}
