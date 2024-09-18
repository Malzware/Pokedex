import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../../shared/services/api.service';
import { Pokemon } from '../../shared/interfaces/pokemon';
import { Ability } from '../../shared/interfaces/ability';
import { Move } from '../../shared/interfaces/move';
import { Evolution } from '../../shared/interfaces/evolution';
import { PokemonVariety } from '../../shared/interfaces/pokemon-variety';

@Component({
  selector: 'app-pokemon-detail',
  templateUrl: './pokemon-detail.component.html',
  styleUrls: ['./pokemon-detail.component.scss']
})
export class PokemonDetailComponent implements OnInit {
  pokemon!: Pokemon;
  abilities: Ability[] = [];
  moves: Move[] = [];
  evolutions!: PokemonVariety[];

  constructor(
    private apiService: ApiService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const pokemonId = params['pokemon_id'];
      if (pokemonId) {
        this.apiService.requestApi(`/pokemon/${pokemonId}`)
          .then((response: Pokemon) => {
            this.pokemon = response;
          });

        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/abilities`)
          .then((response: Ability[]) => {
            this.abilities = response;
          });

        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/moves`)
          .then((response: Move[]) => {
            this.moves = response;
          });

        this.apiService.requestApi(`/pokemon/${pokemonId}/varieties/evolutions`)
          .then((response: PokemonVariety[]) => {
            this.evolutions = response;
          });
      }
    });
  }
}
