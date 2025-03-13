import { Component } from '@angular/core';

@Component({
  selector: 'app-shipping-details',
  templateUrl: './shipping-details.component.html',
  styleUrl: './shipping-details.component.css'
})
export class ShippingDetailsComponent {
  columns: any[] =[
    { key: "customers_name", title: "Vásárló neve", type: "text" },
    { key: "customers_phone", title: "Vásárló telefonszáma", type:"phone" },
    { key: "customers_address", title: "Vásárló címe", type: "text" },
    { key: "payment_method", title: "Fizetési mód", type: "select",
      options: [
        { value: "c.o.d", text: "Utánvét" },
        { value: "shop", text: "Fizetés boltban" },
      ]
    },
  ]
}