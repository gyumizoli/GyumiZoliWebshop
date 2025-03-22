import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-registration',
  host: {
    class: "shaping"
  },
  templateUrl: './registration.component.html',
  styleUrl: './registration.component.css'
})
export class RegistrationComponent {
  confirmPassword = ""
  isPasswordVisible = false
  isConfirmPasswordVisible = false
  toastMessage = ""
  toastType = ""
  isToastVisible = false

  registration:any = { admin: 0 }

  constructor(private base: BaseService, private auth: AuthService, private router: Router) {}

  register() {
    this.auth.register(this.registration).subscribe(
      {
        next: () => {
          const datas = {
            userName: this.registration.name,
            userEmail: this.registration.email
          }
          this.base.successRegistration(datas).subscribe()
          this.registration = {}
          this.confirmPassword = ""
          this.router.navigate(['/login'])
        },
        error: (error) => {
          this.showToast("Hiba! Sikertelen regisztráció!", "danger")
          // console.log("Hiba!", error)
        }
      }
    )
  }

  togglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible;
  }

  toggleConfirmPasswordVisibility() {
    this.isConfirmPasswordVisible = !this.isConfirmPasswordVisible;
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
  }
}