import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent {
  userData:any = {}
  orders:any = []
  selectedOrderItems:any = {}

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
}