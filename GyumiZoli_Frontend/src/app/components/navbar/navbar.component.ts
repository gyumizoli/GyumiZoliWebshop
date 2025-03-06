import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent {
  menuItems:any = [
    {path: "home", text: "Kezdőlap"},
    {path: "fruits", text: "Gyümölcsök"},
    {path: "vegetables", text: "Zöldségek"},
    {path: "sale", text: "Akciók"},
    {path: "aboutus", text: "Rólunk"}
  ];

  selectedLanguage = 'hu';
  languages = [
    { code: 'hu', name: 'Magyar' },
    { code: 'en', name: 'English' }
  ];

  userData:any = null

  constructor(private base: BaseService, private router: Router) {
    const token = localStorage.getItem("authToken")
    if(token){
      this.base.getUserData().subscribe(
        {
          next: (response:any) => {
            this.userData = response.data
          },
          error: (error) => {
            console.log("Felhasználói adatok lekérése sikertelen!", error)
          }
        }
      )
    }
  }

  logout() {
    this.base.logoutUser().subscribe(
      {
        next: (response:any) => {
          localStorage.removeItem("authToken")
          this.userData = null
          this.router.navigate(['/home'])
          console.log("Kijelentkezés sikeres!", response.messsage)
        },
        error: (error) => {
          console.log("Kijelentkezés sikertelen!", error)
        }
      }
    )
  }
}