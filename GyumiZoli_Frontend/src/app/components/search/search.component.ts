import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { SearchService } from '../../services/search.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search',
  host: {
    class: "shaping"
  },
  templateUrl: './search.component.html',
  styleUrl: './search.component.css'
})
export class SearchComponent {
  word: string = ""
  products: any[] = []

  constructor(private base: BaseService, private search: SearchService, private router: Router) {}

  ngOnInit() {
    this.search.getSearchingWord().subscribe((word: string) => {
      this.word = word
      if (word && word.trim() !== "") {
        this.base.getProducts().subscribe({
          next: (data: any) => {
            this.products = data
          },
          error: (error) => console.error("Hiba!", error)
        })
      }
      else {
        this.products = []
      }
    })
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