import { Type } from "./type";

export interface FavoritePokemon {
    id: number;
    name: string;
    category: string;
    default_variety: {
        types?: Type[];   // Types du Pokémon
    }
  }
  