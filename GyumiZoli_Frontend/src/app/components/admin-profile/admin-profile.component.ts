import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-admin-profile',
  host: {
    class: "shaping"
  },
  templateUrl: './admin-profile.component.html',
  styleUrl: './admin-profile.component.css'
})
export class AdminProfileComponent {
  userData: any = {}

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
}