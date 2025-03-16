import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-admin-orders',
  templateUrl: './admin-orders.component.html',
  styleUrl: './admin-orders.component.css'
})
export class AdminOrdersComponent {
  orderForm: FormGroup
  orders:any = []
  selectedOrder:any = {}
  selectedItems:any = {}

  columns: any[] = [
    { key: "id", title: "ID", type: "plain" },
    { key: "user_id", title: "Felhasználó ID", type: "plain" },
    { key: "totalPrice", title: "Végösszeg", type: "number" },
    { key: "payment_method", title: "Fizetési mód", type: "select",
      options: [
        { value: "shop", text: "Boltban" },
        { value: "c.o.d", text: "Utánvét" }
      ]
    },
    { key: "status", title: "Státusz", type: "select",
      options: [
        { value: "pending", text: "Függőben" },
        { value: "processing", text: "Folyamatban" },
        { value: "shipped", text: "Elküldve a boltba" },
        { value: "delivered", text: "Kiszállítva a boltba" },
        { value: "canceled", text: "Törölve" }
      ]
    },
    { key: "customers_name", title: "Megrendelő neve", type: "text" },
    { key: "customers_phone", title: "Megrendelő telefonszáma", type: "text" },
    { key: "delivery_address", title: "Szállítási cím", type: "text" },
    { key: "delivery_date", title: "Szállítási idő", type: "date" },
    { key: "created_at", title: "Rendelés létrehozva", type: "plain" },
    { key: "updated_at", title: "Rendelés módosítva", type: "plain" }
  ]

  orderItemsColumns: any[] = [
    { key: "name", title: "Termék neve", type: "text" },
    { key: "quantity", title: "Mennyiség", type: "number" },
    { key: "discountPrice", title: "Akciós ár", type: "number" },
    { key: "totalPrice", title: "Végösszeg", type: "number" }
  ]

  constructor(private base: BaseService, private formBuilder: FormBuilder) {
    this.base.getOrders().subscribe({
      next: (data: any) => {
        if (!data) {
          console.log("Nincsenek rendelések!")
        } else {
          this.orders = data
        }
      },
      error: (error) => {
        console.error("Hiba! Rendelések lekérdezése sikertelen!", error)
      }
    })

    this.orderForm = this.createForm()
  }

  private createForm(): FormGroup {
    let formGroup:any = {}
    this.columns.forEach(column => formGroup[column.key] = [""])
    return this.formBuilder.group(formGroup)
  }

  chooseItems(order: any) {
    this.selectedItems = [ ...order.items ]
  }

  chooseEditOrder(order:any) {
    if(order.delivery_date) {
      order.delivery_date = new Date(order.delivery_date).toISOString().split('T')[0]
    }
    this.selectedOrder = {...order}
    this.orderForm.patchValue(this.selectedOrder)
  }

  editOrder() {
    this.base.updateOrder(this.selectedOrder).subscribe(
      {
        next: () => {
          this.selectedOrder = {}
          this.orderForm.reset()
        },
        error: (error) => console.error("Hiba! Rendelés módosítása sikertelen!", error)
      }
    )
  }

  chooseDeleteOrder(order:any) {
    this.selectedOrder = {...order}
  }

  deleteOrder() {
    this.base.deleteOrder(this.selectedOrder).subscribe(
      {
        next: () => {
          this.selectedOrder = {}
        },
        error: (error) => console.error("Hiba! Rendelés törlése sikertelen!", error)
      }
    )
  }
}