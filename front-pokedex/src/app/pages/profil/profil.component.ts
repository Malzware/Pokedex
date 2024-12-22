import { Component, OnInit } from '@angular/core';
import { ApiService } from '../../shared/services/api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.scss']
})
export class ProfilComponent implements OnInit {
  user: any;

  constructor(private apiService: ApiService, private router: Router) {}

  ngOnInit() {
    // Vérifier si l'utilisateur est connecté
    if (!this.apiService.isLogged()) {
      this.router.navigate(['/login']);
    } else {
      this.user = this.apiService.user;
    }
  }

  // Méthode de déconnexion
  async logout() {
    await this.apiService.logout();
    this.router.navigate(['/login']);
  }
}
