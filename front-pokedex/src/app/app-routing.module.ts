import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { PokemonListComponent } from './pages/pokemon-list/pokemon-list.component';
import { PokemonDetailComponent } from "./pages/pokemon-detail/pokemon-detail.component";
import { FilterPageComponent } from "./pages/filter-page/filter-page.component"; // Ajoutez ce composant
import { AuthGuard } from './shared/guards/auth.guard';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  {
    path: '',
    component: PokemonListComponent,
    canActivate: [AuthGuard] // Route protégée par AuthGuard
  },
  {
    path: 'filters',
    component: FilterPageComponent, // Route pour la page des filtres
    canActivate: [AuthGuard] // Protéger cette route si nécessaire
  },
  {
    path: 'pokemon/:pokemon_id',
    component: PokemonDetailComponent,
    canActivate: [AuthGuard] // Route protégée
  },
  { path: '**', redirectTo: '' } // Redirige toute route inconnue vers l'accueil
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
