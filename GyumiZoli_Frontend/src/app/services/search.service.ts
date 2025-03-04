import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SearchService {
  searchingSub = new BehaviorSubject("")

  constructor() {}

  getSearchingWord() {
    return this.searchingSub
  }

  setSearchingWord(word:string) {
    this.searchingSub.next(word)
  }
}