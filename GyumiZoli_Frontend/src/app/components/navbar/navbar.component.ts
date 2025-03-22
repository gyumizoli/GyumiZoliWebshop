import { Component, HostListener } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';
import { Subscription } from 'rxjs';
import { BasketService } from '../../services/basket.service';

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
  totalItems: number = 0
  basketSub: Subscription
  isCollapsed = true;
  isMobile = false;

  constructor(private base: BaseService, private router: Router, private basket: BasketService) {
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

    this.basketSub = this.basket.basketItems.subscribe(
      items => {
        this.totalItems = items.length
      }
    )
  }

  @HostListener('window:resize')
  onResize() {
    this.checkMobileView()
  }

  checkMobileView() {
    this.isMobile = window.innerWidth < 768;
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