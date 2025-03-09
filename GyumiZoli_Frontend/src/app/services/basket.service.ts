import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class BasketService {
  basketItems = new BehaviorSubject<any[]>(this.getStoredBasketItems())

  constructor() {}

  addBasket(product: any, quantity: number) {
    const items = this.basketItems.getValue()
    const existingItem = items.find(item => item.product.id === product.id)

    if (existingItem) {
      existingItem.quantity += quantity
    }
    else {
      items.push({product, quantity})
    }
    this.basketItems.next(items)
    this.storeBasketItems(items)
  }

  removeBasketItem(productId: number) {
    let items = this.basketItems.getValue()
    items = items.filter(item => item.product.id !== productId)
    this.basketItems.next(items)
    this.storeBasketItems(items)
  }

  private storeBasketItems(items: any[]) {
    localStorage.setItem("basketItems", JSON.stringify(items))
  }

  private getStoredBasketItems() {
    const stored = localStorage.getItem("basketItems")
    return stored ? JSON.parse(stored) : []
  }
}