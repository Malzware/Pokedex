import { Component, Input, OnInit } from '@angular/core';
import { Ability } from "../../shared/interfaces/ability";
import { Move } from "../../shared/interfaces/move";
import { ApiService } from "../../shared/services/api.service";  // Importation du service

@Component({
  selector: 'app-pokemon-abilities-moves',
  templateUrl: './pokemon-abilities-moves.component.html',
  styleUrls: ['./pokemon-abilities-moves.component.scss']
})
// Dans le fichier pokemon-abilities-moves.component.ts
export class PokemonAbilitiesMovesComponent implements OnInit {
  @Input() abilities!: Ability[];
  @Input() moves!: Move[];
  gameVersions: { id: number, name: string }[] = [];  // Liste des versions du jeu

  selectedMove: Move | null = null;
  filteredMoves: Move[] = [];  // Mouvements filtrés selon la version du jeu
  selectedVersion: number | null = null;  // ID de la version sélectionnée

  constructor(private apiService: ApiService) { }

  ngOnInit(): void {
    // Récupérer toutes les versions de jeu au moment de l'initialisation du composant
    this.apiService.requestApi('/game-versions', 'GET').then(response => {
      // Assigner les versions du jeu reçues dans la variable gameVersions
      this.gameVersions = response; // La réponse contient toutes les versions
      if (this.gameVersions.length > 0) {
        this.selectedVersion = this.gameVersions[0].id;
        this.filterMovesByVersion(this.selectedVersion);  // Appliquer le filtre pour la version par défaut
      }
    }).catch(error => {
      console.error('Erreur lors de la récupération des versions du jeu:', error);
    });
  }

  // Fonction pour filtrer les mouvements par version du jeu
  filterMovesByVersion(versionId: number): void {
    this.selectedVersion = versionId;
    this.filteredMoves = this.moves.filter(move => move.pivot.game_version_id === versionId);
  }

  // Méthode pour obtenir le nom de la version sélectionnée
  getSelectedVersionName(): string {
    const selected = this.gameVersions.find(version => version.id === this.selectedVersion);
    return selected ? selected.name : 'Sélectionner une version';
  }

  openModal(move: Move): void {
    this.selectedMove = move;  // Assigner le mouvement sélectionné
    const modal = document.getElementById('my_modal_3') as HTMLDialogElement;
    if (modal) {
      modal.showModal();  // Ouvrir le modal
    }
  }
}
