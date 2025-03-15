import { Component } from '@angular/core';
import { BasketService } from '../../services/basket.service';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-basket',
  templateUrl: './basket.component.html',
  styleUrl: './basket.component.css'
})
export class BasketComponent {
  basketItems: any[] = []
  totalPrice: number = 0
  userData: any = null

  constructor(private basket: BasketService, private base: BaseService) {
    this.loadBasket()

    const token = localStorage.getItem("authToken")
    if(token){
      this.base.getUserData().subscribe(
        {
          next: (response:any) => {
            this.userData = response.data
          },
          error: (error) => {
            console.log("Felhasználói adatok lekérése sikertelen!", error)
          }
        }
      )
    }
  }

  loadBasket() {
    const items = this.basket.basketItems.getValue()
    this.basketItems = items.map(item => {
      const product = item.product
      const price = Number(product.discount_price) > 0 ? Number(product.discount_price) : Number(product.price)
      const quantity = Number(item.quantity)
      return {
        ...item,
        image: product.image_url,
        name: product.name,
        price: Number(product.price),
        discountPrice: product.discount_price ? Number(product.discount_price) : null,
        totalPrice: quantity * price,
        unit: product.unit
      }
    })
    this.calculateTotalPrice()
  }

  calculateTotalPrice() {
    this.totalPrice = this.basketItems.reduce((sum, item) => sum + Number(item.totalPrice), 0)
  }

  updateItemTotal(item: any) {
    const quantity = Number(item.quantity)
    const price = Number(item.discountPrice ? item.discountPrice : item.price)
    item.totalPrice = quantity * price

    this.calculateTotalPrice()

    const items = this.basket.basketItems.getValue()
    const index = items.findIndex(i => i.product.id === item.product.id)
    if (index !== -1) {
      items[index].quantity = quantity
      this.basket.basketItems.next(items)
    }
  }

  removeItem(productId: number) {
    this.basket.removeBasketItem(productId)
    this.loadBasket()
  }

  checkout() {
    const basketData = {
      user_id: this.userData.id,
      items: this.basketItems,
      totalPrice: this.totalPrice
    }
    localStorage.setItem('basketData', JSON.stringify(basketData));
  }
}