import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

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

  constructor(private base: BaseService) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => this.products = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.log("Hiba! Termékek betöltése sikertelen!", error)
      }
    )
  }
}