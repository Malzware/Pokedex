<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        // Retourne les Pokémon avec leur variété par défaut, leurs sprites et leurs types, paginés
        return Pokemon::with(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types'])
            ->paginate(20);
    }

    public function show(Pokemon $pokemon)
    {
        // Charger le Pokémon avec sa variété par défaut, ses sprites et types
        $pokemon = $pokemon->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);

        // Ajouter le sprite_url pour chaque type de la variété par défaut
        $pokemon->defaultVariety->types->each(function($type) {
            // Assurez-vous d'ajouter l'URL du sprite dans la réponse de type
            $type->sprite_url = $type->sprite_url;
        });

        // Retourner les données du Pokémon avec l'URL du sprite pour les types
        return $pokemon;
    }

    public function showVarieties(Pokemon $pokemon)
    {
        // Charger les variétés de Pokémon avec leurs sprites et types
        $varieties = $pokemon->varieties()->with(['sprites', 'types'])->get();

        // Ajouter l'URL du sprite pour chaque type dans les variétés
        $varieties->each(function($variety) {
            $variety->types->each(function($type) {
                // Ajouter l'URL du sprite de chaque type
                $type->sprite_url = $type->sprite_url;
            });
        });

        // Retourner les variétés de Pokémon avec l'URL du sprite pour les types
        return $varieties;
    }

    public function showEvolution(Pokemon $pokemon)
    {
        // Charger les variétés et les évolutions associées, y compris les sprites et les types
        return $pokemon->varieties()->with([
            'evolutions.evolvesTo.sprites', 
            'evolutions.evolvesTo.types'
        ])->get();
    }    

    public function showMoves(Pokemon $pokemon)
    {
        // Charger les variétés de Pokémon et leurs mouvements
        $varieties = $pokemon->varieties()->with(['moves'])->get();
        $moves = [];

        // Extraire tous les mouvements uniques pour éviter les doublons
        foreach ($varieties as $variety) {
            foreach ($variety->moves as $move) {
                $moves[$move->id] = $move;
            }
        }

        // Retourner la liste de mouvements
        return array_values($moves);
    }

    public function showAbilities(Pokemon $pokemon)
    {
        // Charger les variétés et les capacités associées
        $varieties = $pokemon->varieties()->with('abilities')->get();
        $abilities = [];

        // Ajouter toutes les capacités des variétés
        foreach ($varieties as $variety) {
            foreach ($variety->abilities as $ability) {
                $abilities[] = $ability;
            }
        }

        // Retourner toutes les capacités
        return $abilities;
    }

    public function search(Request $request)
    {
        // Rechercher un Pokémon en fonction du terme de recherche et charger les informations associées
        return Pokemon::search($request->input('query'))
            ->get()
            ->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);
    }
}
