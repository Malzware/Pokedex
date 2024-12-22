import { Component, HostListener } from '@angular/core';
import { Router } from '@angular/router';
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
  isLoading: boolean = false; // Indique si une requête est en cours

  // Correspondance des couleurs pour chaque type (comme dans PokemonDetailComponent)
  private readonly TYPE_COLORS: { [key: string]: string } = {
    normal: '#A8A77A',
    fighting: '#C22E28',
    flying: '#A98FF3',
    poison: '#A33EA1',
    ground: '#E2BF65',
    rock: '#B6A136',
    bug: '#A6B91A',
    ghost: '#735797',
    steel: '#B7B7CE',
    fire: '#EE8130',
    water: '#6390F0',
    grass: '#7AC74C',
    electric: '#F7D02C',
    psychic: '#F95587',
    ice: '#96D9D6',
    dragon: '#6F35FC',
    dark: '#705746',
    fairy: '#D685AD',
    stellar: '#E2E2E2' // Couleur spécifique pour 'stellar'
  };

  constructor(
    public apiService: ApiService,
    private router: Router
  ) {
    console.log('Chargement initial des Pokémons');
    this.loadNextPokemonPage(); // Charger les Pokémons au départ
  }

  // Fonction pour charger la page suivante des Pokémons
  loadNextPokemonPage() {
    if (this.isLoading) {
      return; // Ne pas lancer plusieurs requêtes simultanément
    }

    let page = 1;
    if (this.pokemonList) {
      page = this.pokemonList.current_page + 1;
    }

    if (!this.pokemonList || this.pokemonList.last_page >= page) {
      this.isLoading = true; // Bloquer les requêtes en cours
      console.log(`Chargement de la page ${page} des Pokémons`);
      this.apiService.requestApi('/pokemon', 'GET', { page: page }).then((pokemons: Paginate<Pokemon>) => {
        console.log('Réponse de l\'API pour la page suivante', pokemons);
        if (!this.pokemonList) {
          this.pokemonList = pokemons; // Initialisation
        } else {
          // Concaténation si on charge une nouvelle page
          let datas = this.pokemonList.data.concat(pokemons.data);
          this.pokemonList = { ...pokemons, data: datas };
        }
        console.log('pokemonList après mise à jour', this.pokemonList);
        this.isLoading = false; // Débloquer les requêtes
      }).catch(error => {
        console.error('Erreur lors du chargement des Pokémons :', error);
        this.isLoading = false; // Débloquer même en cas d'erreur
      });
    }
  }

  // Fonction appelée lors de la recherche de Pokémon
  onSearch() {
    console.log('Recherche lancée, query: ', this.searchQuery);

    if (this.searchQuery.length > 0) {
      console.log('Terme de recherche présent, appel à l\'API');
      this.apiService.requestApi('/pokemon/search', 'GET', { query: this.searchQuery }).then((result: Pokemon[]) => {
        console.log('Résultats de la recherche : ', result);
        this.pokemonList = {
          data: result,
          current_page: 1,  // Toujours sur la première page pour la recherche
          last_page: 1,     // Une seule page pour les résultats de la recherche
          per_page: result.length, // Nombre d'éléments retournés
          first_page_url: '/pokemon?page=1',
          from: 1,
          last_page_url: '/pokemon?page=1',
          path: '/pokemon',
          to: result.length,
          total: result.length
        };
        console.log('pokemonList après recherche', this.pokemonList);
      });
    } else {
      console.log('Termes de recherche vides, rechargement des données initiales');
      this.resetPokemonList();
    }
  }

  // Réinitialisation complète de la liste des Pokémon
  resetPokemonList() {
    console.log('Réinitialisation complète de la liste Pokémon');
    this.apiService.requestApi('/pokemon', 'GET', { page: 1 }).then((pokemons: Paginate<Pokemon>) => {
      console.log('Réponse de l\'API pour rechargement des données initiales', pokemons);
      this.pokemonList = pokemons;
      console.log('pokemonList après réinitialisation', this.pokemonList);
    });
  }

  // Détecter le défilement et charger plus de Pokémon
  @HostListener('window:scroll', [])
  onScroll() {
    const scrollPosition = window.innerHeight + window.scrollY;
    const threshold = document.body.offsetHeight - 100; // Charger à 100px avant le bas de page
    if (scrollPosition >= threshold) {
      this.loadNextPokemonPage();
    }
  }

  // Méthode de navigation vers la page des filtres
  navigateToFilterPage() {
    this.router.navigate(['/filters']);
  }

  // Fonction pour générer un style de fond en fonction des types
  getBackgroundStyle(pokemon: Pokemon): string {
    if (!pokemon || !pokemon.default_variety.types) {
      return '';
    }

    const types = pokemon.default_variety.types.map(type => type.name.toLowerCase());

    if (types.length === 1) {
      // Un seul type, couleur unie
      return this.TYPE_COLORS[types[0]] || 'transparent';
    } else if (types.length === 2) {
      // Deux types, appliquer un dégradé
      const color1 = this.TYPE_COLORS[types[0]] || 'transparent';
      const color2 = this.TYPE_COLORS[types[1]] || 'transparent';
      return `linear-gradient(to top right, ${color1}, ${color2})`;
    }
    return '';
  }
}
