import { Component } from '@angular/core';

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
}
