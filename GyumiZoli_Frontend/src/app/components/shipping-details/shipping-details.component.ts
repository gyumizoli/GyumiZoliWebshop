import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-shipping-details',
  templateUrl: './shipping-details.component.html',
  styleUrl: './shipping-details.component.css'
})
export class ShippingDetailsComponent {
  basketData: any = {}
  order:any = {}
  columns: any[] =[
    { key: "customers_name", title: "Vásárló neve", type: "text" },
    { key: "customers_phone", title: "Vásárló telefonszáma", type:"phone" },
    { key: "delivery_address", title: "Szállítási cím", type: "text" },
    { key: "payment_method", title: "Fizetési mód", type: "select",
      options: [
        { value: "card", text: "Fizetés boltban (kártyával)" },
        { value: "cash", text: "Fizetés boltban (készpénzzel)" }
      ]
    },
  ]

  constructor(private base: BaseService) {
    const data = localStorage.getItem("basketData")
    if(data) {
      this.basketData = JSON.parse(data)
    }
    console.log(this.basketData)
  }

  checkout() {
    const deliveryDate = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000)

    this.order = {
      ...this.basketData,
      customers_name: this.columns[0].value,
      customers_phone: this.columns[1].value,
      delivery_address: this.columns[2].value,
      payment_method: this.columns[3].value,
      status: "pending",
      delivery_date: deliveryDate
    }

    this.base.createOrder(this.order).subscribe(
      {
        next: () => {
          console.log("Rendelés sikeresen rögzítve!")
          localStorage.removeItem("basketData")
          localStorage.removeItem("basketItems")
          this.order = {}
        },
        error: (error) => {
          console.log("Rendelés rögzítése sikertelen!", error)
        }
      }
    )
  }
}