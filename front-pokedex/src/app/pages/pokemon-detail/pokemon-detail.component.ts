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
  styleUrl: './pokemon-detail.component.scss'
})
export class PokemonDetailComponent {

  pokemon!: Pokemon;
  abilities!: Ability[];
  moves!: Move[];
  evolutions!: PokemonVariety[];

  constructor(
    private apiService: ApiService,
    private route: ActivatedRoute
  ) {
    // Récupération de l'identifiant du Pokémon dans l'URL
    this.route.params.subscribe(params => {
      const pokemonId = params['pokemon_id'];
      if (pokemonId) {
        // Appel de l'API pour récupérer les informations du Pokémon
        this.apiService.requestApi(`/pokemon/${pokemonId}`)
          .then((response: Pokemon) => {
            this.pokemon = response;
          });

        // Appel de l'API pour récupérer les abilities du Pokémon
        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/abilities`)
          .then((response: Ability[]) => {
            this.abilities = response;
          });

        // Appel de l'API pour récupérer les moves du Pokémon
        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/moves`)
          .then((response: Move[]) => {
            this.moves = response;
          });

        // Appel de l'API pour récupérer les evolutions du Pokémon
        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/evolutions`)
          .then((response: PokemonVariety[]) => {
            this.evolutions = response;
          });

        // Appel de l'API pour récupérer les evolutions du Pokémon
        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/evolutions`)
        .then((response: PokemonVariety[]) => {
          this.evolutions = response;
        });
      }
    });
  }
}
