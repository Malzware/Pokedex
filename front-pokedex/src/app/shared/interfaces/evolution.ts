export interface Evolution {
  id: number;
  pokemon_variety_id: number;
  evolves_to_id: number;
  previousEvolution?: {  // Evolution précédente
    id: number;
    name: string;
    sprites?: {
      front_url?: string;
    };
  };
  nextEvolution?: {  // Evolution suivante
    id: number;
    name: string;
    sprites?: {
      front_url?: string;
    };
  };
}
