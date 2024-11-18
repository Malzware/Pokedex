import { Component, Input, OnInit } from '@angular/core';
import { Pokemon } from "../../shared/interfaces/pokemon";

@Component({
  selector: 'app-pokemon-stats',
  templateUrl: './pokemon-stats.component.html',
  styleUrls: ['./pokemon-stats.component.scss']
})
export class PokemonStatsComponent implements OnInit {
  @Input() pokemon!: Pokemon;
  weaknesses: { name: string, sprite_url: string, interaction_state: string, multiplier: number }[] = [];
  resistances: { name: string, sprite_url: string, interaction_state: string, multiplier: number }[] = [];

  // Données des faiblesses et résistances d'exemple (à remplacer par celles venant du backend)
  weaknessesRaw = [
    { id: 5, name: 'Ground', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/5.png', interaction_state: 'super_effective' },
    { id: 14, name: 'Psychic', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/14.png', interaction_state: 'super_effective' },
    { id: 3, name: 'Flying', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/3.png', interaction_state: 'super_effective' },
    { id: 4, name: 'Poison', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/4.png', interaction_state: 'super_effective' },
    { id: 7, name: 'Bug', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/7.png', interaction_state: 'super_effective' },
    { id: 10, name: 'Fire', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/10.png', interaction_state: 'super_effective' },
    { id: 15, name: 'Ice', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/15.png', interaction_state: 'super_effective' }
  ];

  resistancesRaw = [
    { id: 2, name: 'Fighting', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/2.png', interaction_state: 'resistant' },
    { id: 4, name: 'Poison', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/4.png', interaction_state: 'resistant' },
    { id: 7, name: 'Bug', sprite_url: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-ix/scarlet-violet/7.png', interaction_state: 'resistant' }
  ];

  ngOnInit(): void {
    // Calculer les faiblesses et résistances au démarrage
    this.calculateWeaknessesAndResistances();
  }

  calculateWeaknessesAndResistances(): void {
    // Calcul des faiblesses
    this.weaknesses = this.weaknessesRaw.map(weakness => ({
      ...weakness,
      multiplier: this.getMultiplier(weakness.interaction_state)
    }));

    // Calcul des résistances
    this.resistances = this.resistancesRaw.map(resistance => ({
      ...resistance,
      multiplier: this.getMultiplier(resistance.interaction_state)
    }));
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
