import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  login:any = {
    email: "",
    password: ""
  }
  isPasswordVisible = false;

  constructor(private base: BaseService, private router: Router) {}

  signIn() {
    this.base.loginUser(this.login).subscribe(
      {
        next: (response:any) => {
          if(response && response.data && response.data.token) {
            localStorage.setItem("authToken", response.data.token)
            this.router.navigate(["/profile"])
          }
        },
        error: (error) => {
          console.log("Authentikációs hiba!", error)
        }
      }
    )
    this.login = {}
  }

  togglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible;
  }
}