import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'adminOrderSearch'
})
export class AdminOrderSearchPipe implements PipeTransform {

  transform(orders:any[], word:string): any {
    if(!orders) return null;
    if(!word) return orders;
    return orders.filter(
      (order) => {
        return (
          order.customers_name.toLowerCase().includes(word.toLowerCase()) ||
          order.customers_phone.toLowerCase().includes(word.toLowerCase()) ||
          order.customers_email.toLowerCase().includes(word.toLowerCase()) ||
          order.delivery_address.toLowerCase().includes(word.toLowerCase()) ||
          order.payment_method.toLowerCase().includes(word.toLowerCase()) ||
          order.status.toLowerCase().includes(word.toLowerCase())
        )
      }
    )
  }
}