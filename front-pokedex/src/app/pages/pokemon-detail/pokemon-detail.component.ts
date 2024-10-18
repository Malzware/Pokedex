import { Component } from '@angular/core';
import { Pokemon } from "../../shared/interfaces/pokemon";
import { Ability } from "../../shared/interfaces/ability";
import { Move } from "../../shared/interfaces/move";
import { PokemonVariety } from "../../shared/interfaces/pokemon-variety";
import { ApiService } from "../../shared/services/api.service";
import { ActivatedRoute } from "@angular/router";

@Component({
  selector: 'app-pokemon-detail',
  templateUrl: './pokemon-detail.component.html',
  styleUrls: ['./pokemon-detail.component.scss']
})
export class PokemonDetailComponent {

  pokemon!: Pokemon;
  abilities!: Ability[];
  moves!: Move[];
  evolutions!: PokemonVariety[];
  selectedTab: number = 1; // Onglet par défaut

  // Correspondance des couleurs pour chaque type
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
    private apiService: ApiService,
    private route: ActivatedRoute
  ) {
    // Récupération de l'identifiant du Pokémon dans l'URL
    this.route.params.subscribe(params => {
      const pokemonId = params['pokemon_id'];
      if (pokemonId) {
        this.apiService.requestApi(`/pokemon/${pokemonId}`)
          .then((response: Pokemon) => {
            this.pokemon = response;
          })
          .catch((error) => {
            console.error('Erreur lors de la récupération des détails du Pokémon', error);
          });

        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/abilities`)
          .then((response: Ability[]) => {
            this.abilities = response;
          })
          .catch((error) => {
            console.error('Erreur lors de la récupération des abilities du Pokémon', error);
          });

        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/moves`)
          .then((response: Move[]) => {
            this.moves = response;
          })
          .catch((error) => {
            console.error('Erreur lors de la récupération des moves du Pokémon', error);
          });

        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/evolutions`)
          .then((response: PokemonVariety[]) => {
            this.evolutions = response;
          })
          .catch((error) => {
            console.error('Erreur lors de la récupération des évolutions du Pokémon', error);
          });
      }
    });
  }

  // Fonction pour changer d'onglet
  selectTab(tabIndex: number): void {
    this.selectedTab = tabIndex;
  }

  // Fonction pour générer un style de fond en fonction des types
  getBackgroundStyle(): string {
    if (!this.pokemon || !this.pokemon.default_variety.types) {
      return '';
    }

    const types = this.pokemon.default_variety.types.map(type => type.name.toLowerCase());

    if (types.length === 1) {
      // Un seul type, couleur unie
      return this.TYPE_COLORS[types[0]];
    } else if (types.length === 2) {
      // Deux types, appliquer un dégradé
      const color1 = this.TYPE_COLORS[types[0]];
      const color2 = this.TYPE_COLORS[types[1]];
      return `linear-gradient(to top right, ${color1}, ${color2})`;
    }
    return '';
  }
}
