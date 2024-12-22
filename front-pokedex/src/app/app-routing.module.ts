import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { ProfilComponent } from './pages/profil/profil.component';
import { PokemonListComponent } from './pages/pokemon-list/pokemon-list.component';
import { PokemonDetailComponent } from "./pages/pokemon-detail/pokemon-detail.component";
import { FilterPageComponent } from "./pages/filter-page/filter-page.component"; 
import { AuthGuard } from './shared/guards/auth.guard';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  {
    path: '',
    component: PokemonListComponent, // La page d'accueil sera maintenant PokemonListComponent
    canActivate: [AuthGuard] // Route protégée par AuthGuard
  },
  {
    path: 'pokemon/:pokemon_id',
    component: PokemonDetailComponent,
    canActivate: [AuthGuard] // Route protégée
  },
  {
    path: 'profil', // Ajoutez cette route pour la page Profil
    component: ProfilComponent,
    canActivate: [AuthGuard] // La page Profil est protégée par AuthGuard
  },
  { path: '**', redirectTo: '' } // Redirige toute route inconnue vers l'accueil (PokemonListComponent)
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
