import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { PokemonListComponent } from './pages/pokemon-list/pokemon-list.component';
import {PokemonDetailComponent} from "./pages/pokemon-detail/pokemon-detail.component";
import { AuthGuard } from './shared/guards/auth.guard';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  {
    path: '',
    component: PokemonListComponent,
    canActivate: [AuthGuard]
  },
  {
    path: '',
    component: PokemonListComponent
  },
  {
    path: 'pokemon/:pokemon_id',
    component: PokemonDetailComponent
  }
  // Ajoutez vos autres routes protégées ici...
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }