import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-profile',
  host: {
    class: "shaping"
  },
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent {
  userData:any = {}
  orders:any = []
  selectedOrderItems:any = {}
  old_password:string = ""
  new_password:string = ""
  confirmPassword:string = ""
  new_address:string = ""
  confirmNewAddress:string = ""
  toastMessage = ""
  toastType = ""
  isToastVisible = false

  constructor(private base: BaseService) {
    this.base.getUserData().subscribe(
      {
        next: (response: any) => {
          this.userData = response.data
          this.showToast("Felhasználói adatok betöltve!", "success")
        },
        error: (error) => {
          console.log("Hiba!", error)
          this.showToast("Hiba! Felhasználói adatok betöltése sikertelen!", "danger")
        }
      }
    )
  }

  getOrders() {
    this.base.getOrdersByUser(this.userData.id).subscribe(
      {
        next: (data:any) => {
          this.orders = data
          this.showToast("Rendelések betöltve!", "success")
        },
        error: (error) => {
          this.showToast("Hiba! Rendelések betöltése sikertelen!", "danger")
          console.log("Hiba!", error)
        }
      }
    )
  }

  chooseSelectedItem(order: any) {
    const items = typeof order.items === 'string' ? JSON.parse(order.items) : order.items
    this.selectedOrderItems = [...items]
    console.log(this.selectedOrderItems)
  }

  changePassword() {
    const passwords = {
      old_password: this.old_password,
      new_password: this.new_password
    }

    const data = {
      email: this.userData.email,
      name: this.userData.name
    }
    
    this.base.changePassword(passwords).subscribe(
      {
        next: () => {
          console.log("Sikeres jelszóváltoztatás!")
          this.showToast("Sikeres jelszóváltoztatás!", "success")
          this.old_password = ""
          this.new_password = ""
          this.confirmPassword = ""
          this.base.successChangePassword(data).subscribe(
            {
              next: () => this.showToast("Sikeres e-mail küldés!", "success"),
              error: () => this.showToast("Hiba! E-mail elküldés sikertelen!", "danger")
            }
          )
        },
        error: (error) => {
          console.log("Hiba! Jelszó változtatás sikertelen!", error)
          this.showToast("Hiba! Jelszó változtatás sikertelen!", "danger")
        }
      }
    )
  }

  changeAddress() {
    const address = {
      new_address : this.new_address
    }

    const confirmAddress = {
      name: this.userData.name,
      email: this.userData.email,
      address: this.new_address
    }

    this.base.changeAddress(address).subscribe(
      {
        next: () => {
          console.log("Sikeres cím változtatás!")
          this.showToast("Sikeres cím változtatás!", "success")
          this.new_address = ""
          this.confirmNewAddress = ""
          this.base.successChangeAddress(confirmAddress).subscribe(
            {
              next: () => this.showToast("Sikeres e-mail küldés!", "success"),
              error: () => this.showToast("Hiba! E-mail elküldés sikertelen!", "danger")
            }
          )
        },
        error: (error) => {
          this.showToast("Hiba! Cím változtatás sikertelen!", "danger")
          console.log("Hiba! Cím változtatás sikertelen!", error)
        }
      }
    )
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
  }
}