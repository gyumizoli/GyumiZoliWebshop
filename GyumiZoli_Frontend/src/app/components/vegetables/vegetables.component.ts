import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-vegetables',
  host: {
    class: "shaping"
  },
  templateUrl: './vegetables.component.html',
  styleUrl: './vegetables.component.css'
})
export class VegetablesComponent {
  products:any = []

  constructor(private base: BaseService, private router: Router) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => this.products = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.log("Hiba! Termékek betöltése sikertelen!", error)
      }
    )
  }

  viewProduct(id: number) {
    this.router.navigate(["vegetables", id])
  }
}