import { Injectable } from '@angular/core';
import { environments } from '../../environments/environments';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class BarionService {
  paymentRequest: any

  initializePaymentRequest(basketItems: any[], orderId: any) {
    let totalAmount = 0
    const items = basketItems.map(item => {
      const quantity = Number(item.quantity)
      const price = item.discountPrice ? Number(item.discountPrice) : Number(item.price)
      const itemTotal = quantity * price
      totalAmount += itemTotal
      return {
        Name: item.name,
        Description: item.description,
        Quantity: quantity,
        Unit: item.unit || "nincs mértékegység megadva",
        UnitPrice: price,
        ItemTotal: itemTotal
      };
    });

    this.paymentRequest = {
      POSKey: environments.Pos_key,
      PaymentType: 'Immediate',
      GuestCheckOut: true,
      FundingSources: ['All'],
      OrderNumber: orderId,
      CardHolderNameHint: "",
      PaymentRequestId: "PaymentRequestId_01",
      Transactions: [
        {
          POSTransactionId: 'TRANS001',
          Payee: 'gyumizoli10@gmail.com',
          Total: totalAmount,
          Items: [
            ...items
          ]
        }
      ],
      // URL mindkét helyen véltozik
      RedirectUrl: 'https://cc81-2001-4c4c-1259-e400-c0cb-e69b-183b-4e98.ngrok-free.app/payment-details',
      CallbackUrl: 'https://cc81-2001-4c4c-1259-e400-c0cb-e69b-183b-4e98.ngrok-free.app/callback',
      Currency: 'HUF',
      Locale: 'hu-HU'
    };
  }

  constructor(private http: HttpClient) {}
  startPayment() {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json'
    })
    return this.http.post("https://api.test.barion.com/v2/payment/start", this.paymentRequest, {headers})
  }

  getPaymentState(paymentId:any) {
    const url = "https://api.test.barion.com/v4/payment/"+paymentId+"/paymentstate"
    const headers = new HttpHeaders().set("x-pos-key", environments.Pos_key)
    return this.http.get(url, {headers})
  }
}