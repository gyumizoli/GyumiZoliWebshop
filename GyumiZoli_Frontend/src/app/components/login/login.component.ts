import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-login',
  host: {
    class: "shaping"
  },
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  login:any = {
    email: "",
    password: ""
  }
  isPasswordVisible = false;
  toastMessage = ""
  toastType = ""
  isToastVisible = false

  constructor(private auth: AuthService, private router: Router) {}

  signIn() {
    this.auth.login(this.login.email, this.login.password).subscribe(
      {
        next: () => {
          this.router.navigate(["/profile"])
          this.login = {}
        },
        error: (error) => {
          //console.log("Authentikációs hiba!", error)
          this.showToast("Hiba! Sikertelen bejelentkezés!", "danger")
        }
      }
    )
    
  }

  togglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible;
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
  }
}