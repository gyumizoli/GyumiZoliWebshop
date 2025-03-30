import { Component, ElementRef, HostListener, ViewChild } from '@angular/core';
import { NavigationEnd, Router } from '@angular/router';
import { filter, Subscription } from 'rxjs';
import { BasketService } from '../../services/basket.service';
import { AuthService } from '../../services/auth.service';
import { SearchService } from '../../services/search.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent {
  menuItems:any = [
    {path: "home", text: "🏠 Kezdőlap"},
    {path: "fruits", text: "🍎 Gyümölcsök"},
    {path: "vegetables", text: "🥕 Zöldségek"},
    {path: "sale", text: "💰 Akciók"},
    {path: "aboutus", text: "📝 Rólunk"}
  ]

  adminMenuItems:any = [
    {path: "home", text: "🏠 Kezdőlap"},
    {path: "admin/users", text: "👤 Felhasználók"},
    {path: "admin/products", text: "🍎 Termékek"},
    {path: "admin/orders", text: "📦 Rendelések"}
  ]

  selectedLanguage = 'hu';
  languages = [
    { code: 'hu', name: 'Magyar' },
    { code: 'en', name: 'English' }
  ]

  userData:any = null
  totalItems: number = 0
  basketSub: Subscription
  userSub: Subscription
  isCollapsed = false
  isMobile = false
  isAdminPage = false
  @ViewChild("searchInput") searchInput!: ElementRef<HTMLInputElement>

  constructor(private auth: AuthService, private router: Router, private basket: BasketService, private search: SearchService) {
    this.userSub = this.auth.getLoggedUser().subscribe(
      user => this.userData = user
    )

    this.basketSub = this.basket.basketItems.subscribe(
      items => {
        this.totalItems = items.length
      }
    )
  }

  ngOnInit() {
    this.checkMobileView()
    this.router.events.pipe(
      filter(event => event instanceof NavigationEnd)
    ).subscribe((event: any) => {
      if (event.url.includes("/admin") && this.userData && this.userData.admin === 1) {
        this.isAdminPage = true;
      }
      else {
        this.isAdminPage = false;
      }
    })
  }

  @HostListener('window:resize')
  onResize() {
    this.checkMobileView()
  }

  checkMobileView() {
    this.isMobile = window.innerWidth < 768;
  }

  onSearch(word: string) {
    this.search.setSearchingWord(word)
    this.router.navigate(["/search-result"])
    this.searchInput.nativeElement.value = ""
  }

  logout() {
    this.auth.logout().subscribe()
    this.userData = null
    this.router.navigate(["/home"])
  }
}