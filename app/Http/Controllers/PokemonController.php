<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\PokemonEvolution;
use App\Models\PokemonLearnMove;
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
        return $pokemon->varieties()->with(['learnedMoves.move', 'learnedMoves.move.damageClass', 'learnedMoves.move.type', 'learnedMoves.moveLearnMethod', 'abilities'])->get();
    }
    
    public function search(Request $request)
    {
        return Pokemon::search($request->input('query'))
            ->get()
            ->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);
    }
}
