import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';

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

  constructor(private base: BaseService, private router: Router) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => this.products = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.log("Hiba! Termékek betöltése sikertelen!", error)
      }
    )
  }

  viewProduct(category: string, id: number) {
    let formattedCategory: string;
    if (category.toLowerCase() === "gyümölcs") {
      formattedCategory = 'fruits';
    }
    else if (category.toLowerCase() === "zöldség") {
      formattedCategory = 'vegetables';
    }
    else {
      formattedCategory = category.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
    this.router.navigate([formattedCategory, id]);
  }
}