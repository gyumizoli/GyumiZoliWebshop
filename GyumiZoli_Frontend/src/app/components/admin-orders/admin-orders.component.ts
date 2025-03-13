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
  orderItemsForm: FormGroup
  orders:any = []
  selectedOrder:any = {}
  selectedItems: any = {}

  columns: any[] = [
    { key: "id", title: "ID", type: "plain" },
    { key: "user_id", title: "Felhasználó ID", type: "plain" },
    { key: "shipping_details_id", title: "Megrendelés ID", type: "plain" },
    { key: "status", title: "Státusz", type: "select",
      options: [
        { value: "pending", text: "Függőben" },
        { value: "processing", text: "Folyamatban" },
        { value: "shipped", text: "Elküldve" },
        { value: "delivered", text: "Kiszállítva" },
        { value: "canceled", text: "Törölve" }
      ]
    },
    { key: "customer_name", title: "Megrendelő neve", type: "text" },
    { key: "customer_phone", title: "Megrendelő telefonszáma", type: "text" },
    { key: "shipping_address", title: "Szállítási cím", type: "text" },
    { key: "delivery_date", title: "Szállítási idő", type: "date" },
    { key: "created_at", title: "Rendelés létrehozva", type: "plain" },
    { key: "updated_at", title: "Rendelés módosítva", type: "plain" }
  ]

  orderItemsColumns: any[] = [
    { key: "name", title: "Termék neve", type: "text" },
    { key: "quantity", title: "Mennyiség", type: "number" },
    { key: "discountPrice", title: "Akciós ár", type: "number" },
    { key: "totalPrice", title: "Végösszeg", type: "number" },
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
    this.orderItemsForm = this.createItemsForm()
  }

  private createForm(): FormGroup {
    let formGroup:any = {}
    this.columns.forEach(column => formGroup[column.key] = [""])
    return this.formBuilder.group(formGroup)
  }

  private createItemsForm(): FormGroup {
    let formGroup:any = {}
    this.orderItemsColumns.forEach(column => formGroup[column.key] = [""])
    return this.formBuilder.group(formGroup)
  }

  chooseItems(order: any) {
    this.selectedItems = [ ...order.items ];
    this.orderItemsForm.patchValue({items: this.selectedItems});
  }

  chooseEditOrder(order:any) {
    this.selectedOrder = {...order}
    this.orderForm.patchValue(this.selectedOrder)
  }

  editOrder() {}

  chooseDeleteOrder(order:any) {
    this.selectedOrder = {...order}
  }

  deleteOrder() {}
}