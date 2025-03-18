import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-sale',
  host: {
    class: "shaping"
  },
  templateUrl: './sale.component.html',
  styleUrl: './sale.component.css'
})
export class SaleComponent {
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