export interface Move {
  id: number;
  name: string;
  move_damage_class_id: number;
  accuracy: number;
  power: number;
  pp: number;
  priority: number;
  type_id: number;  // Le type du mouvement
  created_at: string;  // Date de création du mouvement
  updated_at: string;  // Date de dernière mise à jour du mouvement
  description: string;  // Description du mouvement
  pivot: {
      pokemon_variety_id: number;  // ID de la variété de Pokémon
      move_id: number;  // ID du mouvement
      move_learn_method_id: number;  // Méthode d'apprentissage du mouvement
      game_version_id: number;  // Version du jeu
      level: number;  // Niveau d'apprentissage du mouvement
  };
}
