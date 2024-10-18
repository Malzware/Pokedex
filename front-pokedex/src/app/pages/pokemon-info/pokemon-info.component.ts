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
}
