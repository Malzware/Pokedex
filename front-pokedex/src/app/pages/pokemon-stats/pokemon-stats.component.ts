import { Component, Input } from '@angular/core';
import { Pokemon } from "../../shared/interfaces/pokemon";

@Component({
  selector: 'app-pokemon-stats',
  templateUrl: './pokemon-stats.component.html',
  styleUrls: ['./pokemon-stats.component.scss']
})
export class PokemonStatsComponent {
  @Input() pokemon!: Pokemon;
}
