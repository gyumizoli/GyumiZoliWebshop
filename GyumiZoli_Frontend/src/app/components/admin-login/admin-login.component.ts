import { Component } from '@angular/core';

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

  tooglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible;
  }

}
