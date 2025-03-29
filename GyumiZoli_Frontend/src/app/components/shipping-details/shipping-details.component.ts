import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';
import { BasketService } from '../../services/basket.service';

@Component({
  selector: 'app-shipping-details',
  host: {
    class: "shaping"
  },
  templateUrl: './shipping-details.component.html',
  styleUrl: './shipping-details.component.css'
})
export class ShippingDetailsComponent {
  basketData: any = {}
  order:any = {}
  columns: any[] =[
    { key: "customers_name", title: "Vásárló neve", type: "text" },
    { key: "customers_phone", title: "Vásárló telefonszáma", type:"tel" },
    { key: "customers_email", title: "Vásárló e-mail címe", type: "email" },
    { key: "delivery_address", title: "Szállítási cím", type: "text" },
    { key: "payment_method", title: "Fizetési mód", type: "select",
      options: [
        { value: "card", text: "Fizetés boltban (kártyával)" },
        { value: "cash", text: "Fizetés boltban (készpénzzel)" }
      ]
    },
  ]
  toggleState: boolean = false
  toastMessage = ""
  toastType = ""
  isToastVisible = false
  isModalVisible: boolean = false
  countdown: number = 5

  constructor(private base: BaseService, private router: Router, private basket: BasketService) {
    const data = localStorage.getItem("basketData")
    if(data) {
      this.basketData = JSON.parse(data)
    }
    //console.log(this.basketData)
  }

  ngOnInit() {
    this.base.getUserData().subscribe(
      {
        next: (userData: any) => {
          this.columns = this.columns.map((column) => {
            switch (column.key) {
              case "customers_name":
                column.value = userData.data.name
                break
              case "customers_phone":
                column.value = userData.data.phone
                break
              case "customers_email":
                column.value = userData.data.email
                break
              case "delivery_address":
                column.value = userData.data.address
                break
              default:
                column.value = ""
            }
            return column
          }
        )
        this.toggleState = true
      },
      error: (error) => {
        console.log("Hiba! Felhasználó betöltése sikertelen!", error)
      }
    })
  }

  toggleData() {
    if (this.toggleState) {
      this.columns = this.columns.map(column => ({ ...column, value: "" }))
    }
    else {
      this.base.getUserData().subscribe({
        next: (userData: any) => {
          this.columns = this.columns.map((column) => {
            switch (column.key) {
              case "customers_name":
                column.value = userData.data.name
                break
              case "customers_phone":
                column.value = userData.data.phone
                break
              case "customers_email":
                column.value = userData.data.email
                break
              case "delivery_address":
                column.value = userData.data.address
                break
              default:
                column.value = ""
            }
            return column
          })
        },
        error: (error) => {
          console.log("Hiba! Felhasználó betöltése sikertelen!", error)
        }
      })
    }
    this.toggleState = !this.toggleState
  }

  allColumnsValid(): boolean {
    return this.columns.every(c => c.value)
  }

  checkout() {
    const deliveryDate = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000)

    this.order = {
      ...this.basketData,
      customers_name: this.columns[0].value,
      customers_phone: this.columns[1].value,
      customers_email: this.columns[2].value,
      delivery_address: this.columns[3].value,
      payment_method: this.columns[4].value,
      status: "pending",
      delivery_date: deliveryDate
    }

    this.base.createOrder(this.order).subscribe(
      {
        next: () => {
          this.base.successOrder(this.order).subscribe()
          console.log("Rendelés sikeresen rögzítve!")
          localStorage.removeItem("basketData")
          this.basket.deleteBasketItems()
          this.order = {}
        },
        error: (error) => {
          console.log("Rendelés rögzítése sikertelen!", error)
        }
      }
    )
  }

  sendOrder() {
    if (this.allColumnsValid()) {
      this.checkout(),
      this.showSuccessModal()
    } 
    else {
      this.showToast("Kérjük, töltse ki az összes mezőt!", "danger")
    }
  }

  showSuccessModal(): void {
    this.isModalVisible = true;
    this.countdown = 5;
    const intervalId = setInterval(() => {
      this.countdown--;
      if (this.countdown === 0) {
        clearInterval(intervalId);
        this.router.navigate(['/home']);
        this.isModalVisible = false;
      }
    }, 1000);
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
  }
}