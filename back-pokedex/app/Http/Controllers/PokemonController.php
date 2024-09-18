<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        return Pokemon::with(['defaultVariety', 'defaultVariety.sprites'])
            ->paginate(20);
    }

    public function show(Pokemon $pokemon)
    {
        return $pokemon->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);
    }

    public function showVarieties(Pokemon $pokemon)
    {
        return $pokemon->varieties()->with(['sprites', 'types'])->get();
    }

    public function showEvolution(Pokemon $pokemon)
    {
        return $pokemon->varieties()->with('evolutions.evolvesTo.sprites', 'evolutions.evolvesTo.types')->get();
    }

    public function showMoves(Pokemon $pokemon)
    {
        $varieties = $pokemon->varieties()
            ->with(['moves'])
            ->get();

        $moves = [];
        foreach ($varieties as $variety) {
            foreach ($variety->moves as $move) {
                $moves[$move->id] = $move;
            }
        }
        return array_values($moves);
    }

    public function showAbilities(Pokemon $pokemon)
    {
        $varieties = $pokemon->varieties()->with('abilities')->get();
        $abilities = [];
        foreach ($varieties as $variety) {
            foreach ($variety->abilities as $ability) {
                $abilities[] = $ability;
            }
        }
        return $abilities;
    }

    public function search(Request $request)
    {
        return Pokemon::search($request->input('query'))
            ->get()
            ->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);
    }
}
