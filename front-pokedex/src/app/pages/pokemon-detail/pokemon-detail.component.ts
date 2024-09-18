import { Component } from '@angular/core';
import { Pokemon } from "../../shared/interfaces/pokemon";
import { Ability } from "../../shared/interfaces/ability";
import { Move } from "../../shared/interfaces/move";
import { ApiService } from "../../shared/services/api.service";
import { ActivatedRoute } from "@angular/router";

@Component({
  selector: 'app-pokemon-detail',
  templateUrl: './pokemon-detail.component.html',
  styleUrls: ['./pokemon-detail.component.scss']
})
export class PokemonDetailComponent {

  pokemon!: Pokemon;
  abilities: Ability[] = [];
  moves: Move[] = [];

  constructor(
    private apiService: ApiService,
    private route: ActivatedRoute
  ) {
    // Récupération de l'identifiant du Pokémon dans l'URL
    this.route.params.subscribe(params => {
      if (params['pokemon_id']) {
        // Appel de l'API pour récupérer les informations du Pokémon
        this.apiService.requestApi(`/pokemon/${params['pokemon_id']}`)
          .then((response: Pokemon) => {
            this.pokemon = response;
          });

        // Appel de l'API pour récupérer les abilities du Pokémon
        this.apiService.requestApi(`/pokemon/${params['pokemon_id']}/varieties/abilities`)
          .then((response: Ability[]) => {
            this.abilities = response;
          });

        // Appel de l'API pour récupérer les abilities du Pokémon
        this.apiService.requestApi(`/pokemon/${params['pokemon_id']}/varieties/moves`)
          .then((response: Move[]) => {
            console.log('Moves:', response);
            this.moves = response;
          });
      }
    });
  }
}
