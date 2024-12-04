import { Component } from '@angular/core';
import { Router } from '@angular/router'; // Importation du Router
import { ApiService } from "../../shared/services/api.service";
import { Paginate } from "../../shared/interfaces/paginate";
import { Pokemon } from "../../shared/interfaces/pokemon";

@Component({
  selector: 'app-pokemon-list',
  templateUrl: './pokemon-list.component.html',
  styleUrls: ['./pokemon-list.component.scss']
})
export class PokemonListComponent {

  pokemonList?: Paginate<Pokemon>;
  searchQuery: string = '';  // Variable pour la recherche

  constructor(
    public apiService: ApiService,
    private router: Router, // Injection du Router
  ) {
    console.log('Chargement initial des Pokémons');
    this.loadNextPokemonPage(); // Charger les Pokémons au départ
  }

  // Fonction pour charger la page suivante des Pokémons
  loadNextPokemonPage() {
    let page = 1;
    console.log(`Chargement de la page ${page} des Pokémons`);  // Log du numéro de la page initiale
    if (this.pokemonList) {
      page = this.pokemonList.current_page + 1;
      console.log(`Page actuelle : ${this.pokemonList.current_page}, Chargement de la page : ${page}`);
    }

    if (!this.pokemonList || this.pokemonList.last_page <= page) {
      console.log('Appel à l\'API pour charger des Pokémons');
      this.apiService.requestApi('/pokemon', 'GET', { page: page }).then((pokemons: Paginate<Pokemon>) => {
        console.log('Réponse de l\'API pour la page suivante', pokemons);
        if (!this.pokemonList) {
          this.pokemonList = pokemons;
        } else {
          let datas = this.pokemonList.data.concat(pokemons.data);
          this.pokemonList = { ...pokemons, data: datas };
        }
        console.log('pokemonList après mise à jour', this.pokemonList);
      });
    } else {
      console.log('Pas besoin de charger une nouvelle page, déjà à la dernière page.');
    }
  }

  // Fonction appelée lors de la recherche de Pokémon
  onSearch() {
    console.log('Recherche lancée, query: ', this.searchQuery);

    if (this.searchQuery.length > 0) {
      console.log('Terme de recherche présent, appel à l\'API');
      // Si un terme de recherche est présent
      this.apiService.requestApi('/pokemon/search', 'GET', { query: this.searchQuery }).then((result: Pokemon[]) => {
        console.log('Résultats de la recherche : ', result);
        this.pokemonList = {
          data: result,
          current_page: 1,  // Toujours sur la première page pour la recherche
          last_page: 1,     // Une seule page pour les résultats de la recherche
          per_page: result.length, // Nombre d'éléments retournés
          first_page_url: '/pokemon?page=1', // URL de la première page
          from: 1,  // Le premier élément de la page
          last_page_url: '/pokemon?page=1', // URL de la dernière page
          path: '/pokemon', // Le chemin de l'API
          to: result.length, // Le dernier élément de la page
          total: result.length // Nombre total d'éléments trouvés
        };
        console.log('pokemonList après recherche', this.pokemonList);
      });
    } else {
      console.log('Termes de recherche vides, redirection vers la page racine');
      // Si la recherche est vide, redirige vers la page racine et recharge la liste des Pokémon depuis la page 1
      this.router.navigate(['/']).then(() => {
        console.log('Redirection vers la page racine terminée, rechargement des Pokémons');
        // Une fois la navigation effectuée, forcer le chargement de la page 1
        this.pokemonList = undefined;  // Réinitialiser la liste des Pokémon pour forcer le rechargement
        this.loadNextPokemonPage();  // Charger à partir de la première page
      });
    }
  }
}
