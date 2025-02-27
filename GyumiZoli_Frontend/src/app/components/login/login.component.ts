import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

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

  constructor(private base: BaseService) {}

  signIn() {
    this.base.loginUser(this.login)
    this.login = {}
  }

  togglePasswordVisibility() {
    this.isPasswordVisible = !this.isPasswordVisible;
  }
}