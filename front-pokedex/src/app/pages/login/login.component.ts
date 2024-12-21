import { Component } from '@angular/core';
import { ApiService } from '../../shared/services/api.service';

@Component({
  selector: 'app-login',
  template: `
    <div class="flex flex-col items-center justify-center min-h-screen">
      <img 
        src="assets/image/pokeball_pokedex.png" 
        alt="Pokédex" 
      />
      <h1 class="text-5xl font-bold text-gray-800 mb-8">Pokédex</h1>
      <button 
        class="bg-gray-300 text-gray-700 py-3 px-8 rounded-full text-lg font-semibold hover:bg-gray-400 transition"
        (click)="login()"
      >
        Se connecter avec GitHub
      </button>
    </div>
  `,
  styleUrls: []
})
export class LoginComponent {
  constructor(private apiService: ApiService) { }

  async login() {
    await this.apiService.redirectToGithub();
  }
}
