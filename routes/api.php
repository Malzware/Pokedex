<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ItemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'pokemon'], function (){
    Route::get('/', [PokemonController::class, 'index']);
    Route::get('/search', [PokemonController::class, 'search']); // <--- here
    Route::get('/{pokemon}', [PokemonController::class, 'show']);
    Route::get('/{pokemon}/varieties', [PokemonController::class, 'showVarieties']);
});

Route::group(['prefix' => 'item'], function (){
    Route::get('/', [ItemController::class, 'index']);
    Route::get('/search', [ItemController::class, 'search']); // Ajout de la route pour la recherche d'items
    Route::get('/{item}', [ItemController::class, 'show']); // Route pour afficher un item spécifique
});