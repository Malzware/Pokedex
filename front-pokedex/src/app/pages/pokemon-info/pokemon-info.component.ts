import { Component, Input } from '@angular/core';
import { Pokemon } from "../../shared/interfaces/pokemon";
import { PokemonVariety } from "../../shared/interfaces/pokemon-variety";

@Component({
  selector: 'app-pokemon-info',
  templateUrl: './pokemon-info.component.html',
  styleUrls: ['./pokemon-info.component.scss']
})
export class PokemonInfoComponent {
  @Input() pokemon!: Pokemon;
  @Input() evolutions!: PokemonVariety[];

  // Récupérer les évolutions précédentes de toutes les variétés de Pokémon
  get previousEvolutions() {
    const previousEvolutions: any[] = [];
    this.pokemon.varieties.forEach(variety => {
      variety.evolutions.forEach(evolution => {
        if (evolution.previousEvolution) {
          previousEvolutions.push(evolution.previousEvolution);
        }
      });
    });
    return previousEvolutions;
  }

  // Récupérer les évolutions suivantes de toutes les variétés de Pokémon
  get nextEvolutions() {
    const nextEvolutions: any[] = [];
    this.pokemon.varieties.forEach(variety => {
      variety.evolutions.forEach(evolution => {
        if (evolution.nextEvolution) {
          nextEvolutions.push(evolution.nextEvolution);
        }
      });
    });
    return nextEvolutions;
  }
}
