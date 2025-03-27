import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { ActivatedRoute } from '@angular/router';
import { BasketService } from '../../services/basket.service';

@Component({
  selector: 'app-product-detail',
  host: {
    class: "shaping"
  },
  templateUrl: './product-detail.component.html',
  styleUrl: './product-detail.component.css'
})
export class ProductDetailComponent {
  oneproduct:any = {}
  id: string | null
  category: string | null = null
  quantitySelected: number = 0
  totalPrice: number = 0
  toastMessage = ""
  toastType = ""
  isToastVisible = false

  constructor(private base: BaseService, private route: ActivatedRoute, private basket: BasketService) {
    this.id = this.route.snapshot.paramMap.get("id")
    this.category = this.route.snapshot.paramMap.get("category")
    this.base.oneProduct(this.id!).subscribe(
      {
        next: (data: any) => {
          this.oneproduct = data
        },
        error: (error) => console.error('Hiba! Termék lekérése sikertelen!', error)
      }
    )
  }

  updateTotalPrice() {
    if (this.oneproduct.promotion == 1) {
      this.totalPrice = this.oneproduct.discount_price * this.quantitySelected;
    }
    else {
      this.totalPrice = this.oneproduct.price * this.quantitySelected;
    }
  }

  addBasket() {
    if (this.totalPrice === 0) {
      this.showToast("Kérlek válassz mennyiséget!", "danger")
      return
    }
    this.basket.addBasket(this.oneproduct, this.quantitySelected);
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
  }
}