import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms'; // Import FormsModule

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {provideHttpClient, HttpClientModule} from "@angular/common/http";
import { PokemonListComponent } from './pages/pokemon-list/pokemon-list.component';
import { PokemonCardComponent } from './shared/layouts/pokemon-card/pokemon-card.component';
import { PokemonDetailComponent } from './pages/pokemon-detail/pokemon-detail.component';
import { TranslocoRootModule } from './transloco-root.module';
import { LangSelectorComponent } from './shared/layouts/lang-selector/lang-selector.component';
import { PokemonInfoComponent } from './pages/pokemon-info/pokemon-info.component';
import { PokemonStatsComponent } from './pages/pokemon-stats/pokemon-stats.component';
import { PokemonAbilitiesMovesComponent } from './pages/pokemon-abilities-moves/pokemon-abilities-moves.component';
import { LoginComponent } from './pages/login/login.component'; // Import du provider
import { ProfilComponent } from './pages/profil/profil.component';

@NgModule({
  declarations: [
    AppComponent,
    PokemonListComponent,
    PokemonCardComponent,
    PokemonDetailComponent,
    LangSelectorComponent,
    PokemonInfoComponent,
    PokemonStatsComponent,
    PokemonAbilitiesMovesComponent,
    LoginComponent,
    ProfilComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    TranslocoRootModule,
    FormsModule
  ],
  providers: [
    provideHttpClient(), // Ajout du provider
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }