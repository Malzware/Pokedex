<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\PokemonEvolution;
use App\Models\TypeInteraction;
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
        $pokemon->defaultVariety->types->each(function ($type) {
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
        $varieties->each(function ($variety) {
            $variety->types->each(function ($type) {
                // Ajouter l'URL du sprite de chaque type
                $type->sprite_url = $type->sprite_url;
            });
        });

        // Retourner les variétés de Pokémon avec l'URL du sprite pour les types
        return $varieties;
    }

    public function showEvolution(Pokemon $pokemon)
    {
        // Récupérer les évolutions suivantes (Pokémons auxquels ce Pokémon évolue)
        $nextEvolutions = PokemonEvolution::with(['evolvesTo.sprites'])
            ->where('pokemon_variety_id', $pokemon->id) // Pokemon évoluant vers un autre
            ->get()
            ->map(function ($evolution) {
                // Récupérer l'évolution suivante
                $nextPokemon = $evolution->evolvesTo;
                // Trouver l'évolution suivante de ce Pokémon (next evolution)
                $nextEvolution = PokemonEvolution::with(['evolvesTo.sprites'])
                    ->where('pokemon_variety_id', $nextPokemon->id)
                    ->first();

                // Ajout de l'évolution suivante du Pokémon suivant
                $nextPokemon->nextEvolution = $nextEvolution ? $nextEvolution->evolvesTo : null;

                return $nextPokemon;
            });
    }

    public function showMoves(Pokemon $pokemon)
    {
        // Charger les variétés de Pokémon avec leurs mouvements et les types associés
        $varieties = $pokemon->varieties()->with(['moves.type'])->get();
        $moves = [];

        // Ajouter tous les mouvements des variétés
        foreach ($varieties as $variety) {
            foreach ($variety->moves as $move) {
                // Ajouter l'URL du sprite pour le type associé au mouvement
                if ($move->type) {
                    // Assurez-vous que le sprite_url du type est bien chargé
                    $move->type->sprite_url = $move->type->sprite_url;
                }
                $moves[] = $move;
            }
        }

        // Retourner tous les mouvements avec leurs sprite_url et sprite_url des types associés
        return $moves;
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

        // Supprimer les doublons en fonction de l'id de la capacité
        $uniqueAbilities = collect($abilities)->unique('id')->values();

        // Retourner les capacités uniques
        return $uniqueAbilities;
    }

    public function showWeaknessesAndResistances(Pokemon $pokemon)
    {
        // Charger les types associés à la variété par défaut
        $types = $pokemon->defaultVariety->types;

        // Initialiser les données pour résistances, faiblesses et immunités
        $weaknesses = [];
        $resistances = [];
        $immunities = [];

        // Parcours des types de la variété
        foreach ($types as $type) {
            // Charger les interactions où le type est attaqué (en tant que 'to_type_id')
            $interactions = TypeInteraction::where('to_type_id', $type->id)
                ->with(['fromType', 'interactionState']) // Charger les types attaquants et l'état de l'interaction
                ->get();

            // Parcours des interactions
            foreach ($interactions as $interaction) {
                $fromType = $interaction->fromType;  // Type attaquant
                $multiplier = $interaction->interactionState->multiplier; // Multiplicateur des interactions
                $interactionState = $interaction->interactionState->name; // État de l'interaction depuis la BDD

                // Calculer l'état de l'interaction basé sur le multiplicateur
                if ($multiplier > 1) {
                    $interactionState = 'super_effective'; // Faiblesse
                } elseif ($multiplier == 0) {
                    $interactionState = 'immune'; // Immunité
                } elseif ($multiplier < 1) {
                    $interactionState = 'resistant'; // Résistance
                } else {
                    $interactionState = 'normal'; // Interaction normale
                }

                // Créer un tableau de données de l'interaction
                $interactionData = [
                    'id' => $fromType->id,
                    'name' => $fromType->name,
                    'sprite_url' => $fromType->sprite_url,
                    'multiplier' => $multiplier,
                    'interaction_state' => $interactionState,
                ];

                // Classer les interactions en fonction de l'état de l'interaction
                switch ($interactionState) {
                    case 'super_effective':
                        $weaknesses[$fromType->id] = $interactionData; // Ajouter aux faiblesses (clé unique pour chaque type)
                        break;
                    case 'immune':
                        $immunities[$fromType->id] = $interactionData; // Ajouter aux immunités
                        break;
                    case 'resistant':
                        $resistances[$fromType->id] = $interactionData; // Ajouter aux résistances
                        break;
                    case 'normal':
                        // Pas nécessaire de faire quelque chose pour l'état normal
                        break;
                }
            }
        }

        // Retourner les faiblesses, résistances et immunités sous forme de tableaux
        return [
            'weaknesses' => array_values($weaknesses), // Convertir les clés en indices numériques
            'resistances' => array_values($resistances),
            'immunities' => array_values($immunities),
        ];
    }

    public function store(Request $request, Pokemon $pokemon)
    {
        // Vérifiez si l'utilisateur est authentifié
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $validated = $request->validate([
            'pokemon_id' => 'required|exists:Pokemon,id', // Utilisez "Pokemon" ici
        ]);

        $pokemonId = $validated['pokemon_id'];

        // Vérifiez si l'association existe déjà
        if ($user->pokemon()->where('pokemon_id', $pokemonId)->exists()) {
            return response()->json(['message' => 'Pokemon already saved'], 409);
        }

        // Ajoutez l'association à la table pivot
        $user->pokemon()->attach($pokemonId);

        return response()->json(['message' => 'Pokemon saved successfully']);
    }

    public function showFavorites(Request $request)
    {
        // Vérifiez si l'utilisateur est authentifié
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Récupérer les pokémons favoris de l'utilisateur avec leurs variétés, sprites et types
        $favorites = $user->pokemon()->with(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types'])->get();

        // Retourner les détails complets des pokémons favoris
        return response()->json($favorites);
    }


    public function search(Request $request)
    {
        // Rechercher un Pokémon en fonction du terme de recherche et charger les informations associées
        return Pokemon::search($request->input('query'))
            ->get()
            ->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);
    }
}
