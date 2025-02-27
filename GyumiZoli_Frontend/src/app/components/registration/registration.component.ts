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

  registration:any = {
    name: "",
    email: "",
    password: "",
    phone: "",
    birth_date: "",
    admin: 0
  }

  constructor(private base: BaseService) {}

  register() {
    this.base.addUser(this.registration)
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