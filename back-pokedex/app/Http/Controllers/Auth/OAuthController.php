<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
  public function redirect()
  {
    // Rediriger vers l'URL d'authentification GitHub
    return response()->json([
      'url' => Socialite::driver('github')->stateless()->redirect()->getTargetUrl(),
    ]);
  }

  public function callback(Request $request)
  {
    try {
      // Récupérer les informations de l'utilisateur GitHub
      $githubUser = Socialite::driver('github')->stateless()->user();

      // Créer ou mettre à jour l'utilisateur dans la base de données
      $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
      ], [
        'name' => $githubUser->name ?? $githubUser->nickname,
        'email' => $githubUser->email,
        'profil_picture_url' => $githubUser->avatar,
      ]);

      // Générer un token Sanctum pour l'utilisateur
      $token = $user->createToken('auth_token')->plainTextToken;

      // Retourner l'utilisateur et le token
      return response()->json([
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer'
      ]);

    } catch (\Exception $e) {
      // Gérer les erreurs
      return response()->json([
        'message' => 'Une erreur est survenue pendant l\'authentification',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function logout(Request $request)
  {
    // Supprimer le token actif
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Déconnecté avec succès']);
  }
}
