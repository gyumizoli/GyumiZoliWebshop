import { Component, ElementRef, ViewChild } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent {
  @ViewChild("scrollAreaFruits", { static: false }) scrollAreaFruits!: ElementRef
  @ViewChild("scrollAreaVegetables", { static: false }) scrollAreaVegetables!: ElementRef
  @ViewChild("scrollAreaSales", { static: false }) scrollAreaSales!: ElementRef
  products:any = []

  constructor(private base: BaseService, private router: Router) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => this.products = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.log("Hiba! Főoldal termékeinek betöltése sikertelen!", error)
      }
    )
  }

  scrollLeftFruits() {
    if(this.scrollAreaFruits) {
      this.scrollAreaFruits.nativeElement.scrollBy(
        { left: -200, behavior: "smooth" }
      )
    }
  }

  scrollRightFruits() {
    if(this.scrollAreaFruits) {
      this.scrollAreaFruits.nativeElement.scrollBy(
        { left: 200, behavior: "smooth" }
      )
    }
  }

  scrollLeftVegetables() {
    if(this.scrollAreaVegetables) {
      this.scrollAreaVegetables.nativeElement.scrollBy(
        { left: -200, behavior: "smooth" }
      )
    }
  }

  scrollRightVegetables() {
    if(this.scrollAreaVegetables) {
      this.scrollAreaVegetables.nativeElement.scrollBy(
        { left: 200, behavior: "smooth" }
      )
    }
  }

  scrollLeftSales() {
    if(this.scrollAreaSales) {
      this.scrollAreaSales.nativeElement.scrollBy(
        { left: -200, behavior: "smooth" }
      )
    }
  }

  scrollRightSales() {
    if(this.scrollAreaSales) {
      this.scrollAreaSales.nativeElement.scrollBy(
        { left: 200, behavior: "smooth" }
      )
    }
  }

  viewProduct(category: string, id: number) {
    let formattedCategory: string;
    if (category.toLowerCase() === "gyümölcs") {
      formattedCategory = 'fruits';
    }
    else if (category.toLowerCase() === "zöldség") {
      formattedCategory = 'vegetables';
    }
    else {
      formattedCategory = category.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
    this.router.navigate([formattedCategory, id]);
  }
}