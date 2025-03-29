import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { BarionService } from '../../services/barion.service';
import { BasketService } from '../../services/basket.service';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-payment',
  templateUrl: './payment.component.html',
  styleUrl: './payment.component.css'
})
export class PaymentComponent {
  paymentId:any
  title:any
  order:any
  orderNumber:any

  constructor(private route: ActivatedRoute, private barion: BarionService, private basket: BasketService, private base: BaseService) {
    this.route.queryParams.subscribe(
      (res:any) => {
        this.paymentId = res.paymentId
        console.log(this.paymentId)
        this.checkPayment(this.paymentId)
      }
    )
  }

  checkPayment(paymentId:any) {
    this.barion.getPaymentState(paymentId).subscribe(
      (res:any) => {
        if (res.Status === "Succeeded" || res.Status === "Reserved") {
          this.title = "Köszönjük a megrendelést! A megadott e-mail címre elküldtük a rendelés részleteit."
          this.orderNumber = "Megrendelés azonosító: "+res.OrderNumber
          const orderData = localStorage.getItem("pendingOrder")
          if(orderData) {
            this.order = JSON.parse(orderData)
            localStorage.removeItem("pendingOrder")
          }
          this.base.successOrder(this.order).subscribe()
          this.order = {}
          localStorage.removeItem("basketData")
          this.basket.deleteBasketItems()
        }
        else {
          this.title = "Nem sikerült a fizetés! Kérjük, próbálja újra."
        }
      } 
    )
  }
}