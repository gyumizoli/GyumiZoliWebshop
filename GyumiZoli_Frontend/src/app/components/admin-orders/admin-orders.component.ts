import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { BaseService } from '../../services/base.service';
import { SearchService } from '../../services/search.service';

@Component({
  selector: 'app-admin-orders',
  host: {
    class: "shaping"
  },
  templateUrl: './admin-orders.component.html',
  styleUrl: './admin-orders.component.css'
})
export class AdminOrdersComponent {
  orderForm: FormGroup
  orders:any = []
  selectedOrder:any = {}
  selectedItems:any = {}
  word = ""
  toastMessage = ""
  toastType = ""
  isToastVisible = false

  columns: any[] = [
    { key: "id", title: "ID", type: "plain" },
    { key: "user_id", title: "Felhasználó ID", type: "plain" },
    { key: "totalPrice", title: "Végösszeg", type: "number" },
    { key: "payment_method", title: "Fizetési mód", type: "select",
      options: [
        { value: "card", text: "Bankkártyával" },
        { value: "cash", text: "Készpénzzel" }
      ]
    },
    { key: "status", title: "Státusz", type: "select",
      options: [
        { value: "pending", text: "Függőben" },
        { value: "processing", text: "Folyamatban" },
        { value: "shipped", text: "Elküldve" },
        { value: "delivered", text: "Kiszállítva" },
        { value: "cancelled", text: "Törölve" }
      ]
    },
    { key: "customers_name", title: "Megrendelő neve", type: "text" },
    { key: "customers_phone", title: "Megrendelő telefonszáma", type: "text" },
    { key: "customers_email", title: "Megrendelő e-mail címe", type: "text" },
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

  constructor(private base: BaseService, private formBuilder: FormBuilder, private search: SearchService) {
    this.base.getOrders().subscribe({
      next: (data: any) => {
        if (!data) {
          this.showToast("Nincsenek rendelés adatok!", "error")
        }
        else {
          this.orders = data
          this.showToast("Rendelések betöltve!", "success")
        }
      },
      error: (error) => {
        console.error("Hiba! Rendelések lekérdezése sikertelen!", error)
        this.showToast("Hiba! Rendelések lekérdezése sikertelen!", "error")
      }
    })

    this.search.getSearchingWord().subscribe(
      (data) => this.word = data
    )

    this.orderForm = this.createForm()
  }

  ngOnInit() {
    this.search.clearSearchingWord()
  }

  private createForm(): FormGroup {
    let formGroup:any = {}
    this.columns.forEach(column => formGroup[column.key] = [""])
    return this.formBuilder.group(formGroup)
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
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
    const originalOrder = this.orderForm.value
    
    this.base.updateOrder(this.selectedOrder).subscribe(
      {
        next: () => {
          if(originalOrder.status !== this.selectedOrder.status || originalOrder.delivery_date !== this.selectedOrder.delivery_date) {
            const orderStatus = {
              id: this.selectedOrder.id,
              name: this.selectedOrder.customers_name,
              email: this.selectedOrder.customers_email,
              status: this.selectedOrder.status,
              delivery_date: this.selectedOrder.delivery_date
            }
            this.base.sendOrderStatus(orderStatus).subscribe(
              {
                next: () => {
                  console.log("Rendelés státusz e-mail elküldve!")
                  this.showToast("Rendelés státusz e-mail elküldve!", "success")
                },
                error: (error) => {
                  console.error("Hiba! Rendelés státusz e-mail küldése sikertelen!", error)
                  this.showToast("Hiba! Rendelés státusz e-mail küldése sikertelen!", "error")
                }
              }
            )
          }
          this.selectedOrder = {}
          this.orderForm.reset()
          this.showToast("Rendelés módosítva!", "success")
        },
        error: (error) => {
          console.error("Hiba! Rendelés módosítása sikertelen!", error)
          this.showToast("Hiba! Rendelés módosítása sikertelen!", "error")
        }
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
          this.showToast("Rendelés törölve!", "success")
        },
        error: (error) => {
          console.error("Hiba! Rendelés törlése sikertelen!", error)
          this.showToast("Hiba! Rendelés törlése sikertelen!", "error")
        }
      }
    )
  }

  setSearch(event:any) {
    this.search.setSearchingWord(event.target.value)
  }

  deleteSearch() {
    this.word = ""
  }
}