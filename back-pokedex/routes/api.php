<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\GameVersionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\OAuthController;

Route::prefix('auth')->group(function () {
    Route::get('/redirect', [OAuthController::class, 'redirect']);
    Route::get('/callback', [OAuthController::class, 'callback']);
    Route::middleware('auth:sanctum')->post('/logout', [OAuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/game-versions', [GameVersionController::class, 'index']);
    Route::group(['prefix' => 'pokemon'], function () {
        Route::get('/', [PokemonController::class, 'index']);
        Route::get('/search', [PokemonController::class, 'search']);
        Route::get('/{pokemon}', [PokemonController::class, 'show']);
        Route::get('/{pokemon}/varieties', [PokemonController::class, 'showVarieties']);
        Route::get('/{pokemon}/varieties/evolutions', [PokemonController::class, 'showEvolution']);
        Route::get('/{pokemon}/varieties/oldevolutions', [PokemonController::class, 'showOldEvolution']);
        Route::get('/{pokemon}/varieties/moves', [PokemonController::class, 'showMoves']);
        Route::get('/{pokemon}/varieties/abilities', [PokemonController::class, 'showAbilities']);
        Route::get('/{pokemon}/varieties/interactions', [PokemonController::class, 'showWeaknessesAndResistances']);
        Route::post('/{pokemon}/varieties/pokemon-user', [PokemonController::class, 'store']);
        Route::get('/favorites', [PokemonController::class, 'showFavorites']);
    });    
});