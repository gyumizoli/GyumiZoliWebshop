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

  constructor(private base: BaseService) {
    this.base.getUserData().subscribe(
      {
        next: (response: any) => {
          this.userData = response.data
        },
        error: (error) => console.log("Hiba!", error)
      }
    )
  }

  getOrders() {
    this.base.getOrdersByUser(this.userData.id).subscribe(
      {
        next: (data:any) => {
          this.orders = data
        },
        error: (error) => {
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
          this.old_password = ""
          this.new_password = ""
          this.confirmPassword = ""
          this.base.successChangePassword(data).subscribe()
        },
        error: (error) => console.log("Hiba! Jelszó változtatás sikertelen!", error)
      }
    )
  }

  changeAddress() {
    const address = {
      address : this.new_address
    }

    const confirmAddress = {
      address: this.new_address,
      name: this.userData.name
    }

    this.base.changeAddress(address).subscribe(
      {
        next: () => {
          console.log("Sikeres cím változtatás!")
          this.new_address = ""
          this.confirmNewAddress = ""
          this.base.successChangeAddress(confirmAddress).subscribe()
        },
        error: (error) => console.log("Hiba! Cím változtatás sikertelen!", error)
      }
    )
  }
}