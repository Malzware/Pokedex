<?php

namespace App\Http\Controllers;

use App\Models\GameVersion;
use Illuminate\Http\Request;

class GameVersionController extends Controller
{
    /**
     * Afficher les détails d'une version de jeu en fonction de son ID.
     *
     * @param int $gameVersionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Récupérer toutes les versions de jeu
        $gameVersions = GameVersion::with('gameVersionTranslations')->get();
    
        // Retourner les informations des versions de jeu en réponse JSON
        return response()->json($gameVersions);
    }    
}
