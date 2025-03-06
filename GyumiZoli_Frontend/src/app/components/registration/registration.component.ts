import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrl: './registration.component.css'
})
export class RegistrationComponent {
  confirmPassword = "";
  isPasswordVisible = false;
  isConfirmPasswordVisible = false;

  registration:any = { admin: 0 }

  constructor(private base: BaseService) {}

  register() {
    this.base.addUser(this.registration).subscribe(
      {
        next: (data:any) => {
          console.log("Sikeres regisztráció!", data)
        },
        error: (error) => {
          console.error("Hiba történt a regisztráció során!", error)
        }
      }
    )
    this.registration = {}
    this.confirmPassword = ""
  }

  togglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible;
  }

  toggleConfirmPasswordVisibility() {
    this.isConfirmPasswordVisible = !this.isConfirmPasswordVisible;
  }
}