import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent {
  userData:any = {}

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