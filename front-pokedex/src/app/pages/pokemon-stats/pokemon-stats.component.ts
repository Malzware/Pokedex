import { Component, Input, OnInit } from '@angular/core';
import { Pokemon } from "../../shared/interfaces/pokemon";
import { ApiService } from "../../shared/services/api.service";  // Importing the ApiService

@Component({
  selector: 'app-pokemon-stats',
  templateUrl: './pokemon-stats.component.html',
  styleUrls: ['./pokemon-stats.component.scss']
})
export class PokemonStatsComponent implements OnInit {
  @Input() pokemon!: Pokemon;
  weaknesses: { name: string, sprite_url: string, interaction_state: string, multiplier: number }[] = [];
  resistances: { name: string, sprite_url: string, interaction_state: string, multiplier: number }[] = [];
  immunities: { name: string, sprite_url: string, interaction_state: string, multiplier: number }[] = [];

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.loadWeaknessesAndResistances();
  }

  async loadWeaknessesAndResistances(): Promise<void> {
    try {
      // Making the API request to fetch weaknesses and resistances using requestApi
      const data = await this.apiService.requestApi(`/pokemon/${this.pokemon.id}/interactions`, 'GET');
      
      this.weaknesses = data.weaknesses.map((weakness: any) => ({
        ...weakness,
        multiplier: this.getMultiplier(weakness.interaction_state)
      }));

      this.resistances = data.resistances.map((resistance: any) => ({
        ...resistance,
        multiplier: this.getMultiplier(resistance.interaction_state)
      }));

      this.immunities = data.immunities.map((immunity: any) => ({
        ...immunity,
        multiplier: this.getMultiplier(immunity.interaction_state)
      }));

    } catch (error) {
      console.error('Error loading weaknesses and resistances', error);
    }
  }

  getMultiplier(interactionState: string): number {
    switch (interactionState) {
      case 'super_effective':
        return 2;
      case 'resistant':
        return 0.5;
      case 'immune':
        return 0;
      default:
        return 1;
    }
  }
}
