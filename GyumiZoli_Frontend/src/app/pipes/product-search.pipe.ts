import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'productSearch'
})
export class ProductSearchPipe implements PipeTransform {
  transform(products:any[], word:string): any {
    if(!products) return null;
    if(!word) return products;
    return products.filter(
      (product) => {
        return (
          product.name.toLowerCase().includes(word.toLowerCase()) ||
          product.description.toLowerCase().includes(word.toLowerCase())
        )
      }
    )
  }
}