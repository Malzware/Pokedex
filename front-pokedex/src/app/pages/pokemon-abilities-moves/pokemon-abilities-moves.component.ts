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

  selectedMove: Move | null = null;  // Assurez-vous que selectedMove est soit null, soit un objet Move valide

  openModal(move: Move): void {
    this.selectedMove = move;  // Assigner le mouvement sélectionné
    const modal = document.getElementById('my_modal_3') as HTMLDialogElement;
    if (modal) {
      modal.showModal();  // Ouvrir le modal
    }
  }
}
