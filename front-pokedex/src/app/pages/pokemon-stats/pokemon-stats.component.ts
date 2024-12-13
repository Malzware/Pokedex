import { Component, Input, OnInit } from '@angular/core';
import { ApiService } from '../../shared/services/api.service';
import { Pokemon } from "../../shared/interfaces/pokemon";

@Component({
  selector: 'app-pokemon-stats',
  templateUrl: './pokemon-stats.component.html',
  styleUrls: ['./pokemon-stats.component.scss']
})
export class PokemonStatsComponent implements OnInit {
  @Input() pokemon!: Pokemon;
  weaknesses: { name: string, sprite_url: string, multiplier: number }[] = [];
  resistances: { name: string, sprite_url: string, multiplier: number }[] = [];
  immunities: { name: string, sprite_url: string, multiplier: number }[] = [];

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    if (this.pokemon) {
      this.loadInteractions(); // Charger les interactions uniquement si le Pokémon est disponible
    }
  }

  loadInteractions(): void {
    this.apiService.requestApi(`/pokemon/${this.pokemon.id}/varieties/interactions`, 'GET')
      .then((data: any) => {
        this.weaknesses = data.weaknesses;
        this.resistances = data.resistances;
        this.immunities = data.immunities;
      })
      .catch(error => {
        console.error('Erreur lors du chargement des interactions:', error);
      });
  }

  // Fonction de regroupement par multiplicateur
  groupByMultiplier(array: { name: string; sprite_url: string; multiplier: number }[]) {
    const grouped = array.reduce((acc, item) => {
      const existingGroup = acc.find(group => group.multiplier === item.multiplier);
      if (existingGroup) {
        existingGroup.items.push(item);
      } else {
        acc.push({ multiplier: item.multiplier, items: [item] });
      }
      return acc;
    }, [] as { multiplier: number; items: { name: string; sprite_url: string; multiplier: number }[] }[]);
    return grouped;
  }
}
