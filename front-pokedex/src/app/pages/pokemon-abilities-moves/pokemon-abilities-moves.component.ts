import { Component, Input } from '@angular/core';
import { Ability } from "../../shared/interfaces/ability";
import { Move } from "../../shared/interfaces/move";

@Component({
  selector: 'app-pokemon-abilities-moves',
  templateUrl: './pokemon-abilities-moves.component.html',
  styleUrls: ['./pokemon-abilities-moves.component.scss']
})
export class PokemonAbilitiesMovesComponent {
  @Input() abilities!: Ability[];
  @Input() moves!: Move[];
}
