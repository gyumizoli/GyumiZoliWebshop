import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'adminProductSearch'
})
export class AdminProductSearchPipe implements PipeTransform {
  transform(products:any[], word:string): any {
    if(!products) return null;
    if(!word) return products;
    return products.filter(
      (product) => {
        return (
          product.description.toLowerCase().includes(word.toLowerCase()) ||
          product.name.toLowerCase().includes(word.toLowerCase())
        )
      }
    )
  }
}