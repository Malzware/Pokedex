import { Component, OnInit } from '@angular/core';
import { ApiService } from '../../shared/services/api.service';
import { Router } from '@angular/router';
import { FavoritePokemon } from '../../shared/interfaces/favorite';  // Importer l'interface

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.scss']
})
export class ProfilComponent implements OnInit {
  user: any;
  favoritePokemons: FavoritePokemon[] = [];  // Liste des Pokémon favoris
  apiResponse: string = '';  // Réponse brute de l'API pour le débogage
  selectedCategory: string | null = null;  // Catégorie sélectionnée pour filtrer les Pokémon favoris

  constructor(private apiService: ApiService, private router: Router) {}

  ngOnInit() {
    console.log('ProfilComponent: ngOnInit called');
    
    // Vérifier si l'utilisateur est connecté
    if (!this.apiService.isLogged()) {
      console.log('Utilisateur non connecté, redirection vers login');
      this.router.navigate(['/login']);
    } else {
      this.user = this.apiService.user;
      console.log('Utilisateur connecté:', this.user);  // Vérifier les données de l'utilisateur

      // Charger les pokémons favoris
      this.loadFavoritePokemons();
    }
  }

  loadFavoritePokemons() {
    console.log('Chargement des pokémons favoris...');
    this.apiService.requestApi('/pokemon/favorites', 'GET')
      .then(data => {
        console.log('Réponse de l\'API pour les pokémons favoris:', data);
        
        if (Array.isArray(data)) {
          this.favoritePokemons = data;
          console.log('Pokémons favoris chargés:', this.favoritePokemons);  // Vérifier ici
        } else {
          console.error('Les données des pokémons favoris ne sont pas un tableau:', data);
        }
  
        // Affichage des données sous forme JSON pour débogage
        this.apiResponse = JSON.stringify(data, null, 2);
      })
      .catch(error => {
        console.error('Erreur lors du chargement des pokémons favoris:', error);
        this.apiResponse = `Erreur lors de la requête API : ${error}`;
      });
  }
  

  // Méthode de déconnexion
  /* async logout() {
    console.log('Déconnexion en cours...');
    await this.apiService.logout();
    this.router.navigate(['/login']);
  } */

  // Filtrer les pokémons par catégorie
  filterByCategory(category: string): void {
    this.selectedCategory = category;
  }
}
