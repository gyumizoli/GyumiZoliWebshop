import { Component } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-admin-login',
  host: {
    class: "shaping"
  },
  templateUrl: './admin-login.component.html',
  styleUrl: './admin-login.component.css'
})
export class AdminLoginComponent {
  isPasswordVisible = false;
  login:any = {
    email: "",
    password: ""
  }

  constructor(private auth: AuthService, private router: Router) {}

  signIn() {
    this.auth.login(this.login.email, this.login.password).subscribe(
      {
        next: () => {
          this.auth.getIsAdmin().subscribe(isAdmin => {
            if(isAdmin) {
              this.router.navigate(["/admin/profile"])
            } 
            else {
              this.router.navigate(["/profile"])
            }
          })
        },
        error: (error) => {
          console.log("Authentikációs hiba!", error)
        }
      }
    )
  }

  tooglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible
  }
}