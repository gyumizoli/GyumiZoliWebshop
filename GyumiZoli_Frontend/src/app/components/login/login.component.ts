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

  constructor(private auth: AuthService, private router: Router) {}

  signIn() {
    this.auth.login(this.login.email, this.login.password).subscribe(
      {
        next: () => {
          this.router.navigate(["/profile"])
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