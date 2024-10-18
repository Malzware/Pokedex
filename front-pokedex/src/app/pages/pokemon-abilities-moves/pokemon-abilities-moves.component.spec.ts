import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PokemonAbilitiesMovesComponent } from './pokemon-abilities-moves.component';

describe('PokemonAbilitiesMovesComponent', () => {
  let component: PokemonAbilitiesMovesComponent;
  let fixture: ComponentFixture<PokemonAbilitiesMovesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PokemonAbilitiesMovesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PokemonAbilitiesMovesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
