export interface Evolution {
    id: number;
    pokemon_variety_id: number;
    evolves_to_id: number;
    evolves_to: {
      id: number;
      name: string;
      sprites?: {
        front_url?: string;
      };
    };
  }
  