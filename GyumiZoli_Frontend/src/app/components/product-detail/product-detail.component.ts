import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrl: './product-detail.component.css'
})
export class ProductDetailComponent {
  oneproduct:any = {}
  id: string | null
  category: string | null = null
  quantitySelected: number = 0
  totalPrice: number = 0

  constructor(private base: BaseService, private route: ActivatedRoute) {
    this.id = this.route.snapshot.paramMap.get("id")
    this.category = this.route.snapshot.paramMap.get("category")
    this.base.oneProduct(this.id!).subscribe(
      {
        next: (data: any) => {
          this.oneproduct = data
        },
        error: (error) => console.error('Hiba! Termék lekérése sikertelen!', error)
      }
    );
  }

  updateTotalPrice() {
    if (this.oneproduct.promotion == 1) {
      this.totalPrice = this.oneproduct.discount_price * this.quantitySelected;
    } 
    else {
      this.totalPrice = this.oneproduct.price * this.quantitySelected;
    }
  }
}