import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-fruits',
  host: {
    class: "shaping"
  },
  templateUrl: './fruits.component.html',
  styleUrl: './fruits.component.css'
})
export class FruitsComponent {
  products:any = []

  constructor(private base: BaseService, private router: Router) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => this.products = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.error("Hiba! Termékek betöltése sikertelen!", error)
      }
    )
  }

  viewProduct(id: number) {
    this.router.navigate(["fruits", id])
  }
}