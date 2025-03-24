import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class BaseService {
  private apiUrl = "http://127.0.0.1:8000/api/"

  private userSubject = new BehaviorSubject([])
  private productsSubject = new BehaviorSubject([])
  private ordersSubject = new BehaviorSubject<any[]>([])

  constructor(private http: HttpClient) {
    this.loadUsers()
    this.loadProducts()
    this.loadOrders()
  }

  getUsers() {
    return this.userSubject
  }

  getProducts() {
    return this.productsSubject
  }

  getOrders() {
    return this.ordersSubject
  }

  private loadUsers() {
    this.http.get(this.apiUrl+"users").subscribe(
      {
        next: (data:any) => this.userSubject.next(data),
        error: (error) => console.log("Hiba! Felhasználók betöltése sikertelen!", error)
      }
    )
  }

  private loadProducts() {
    this.http.get(this.apiUrl+"products").subscribe(
      {
        next: (data:any) => this.productsSubject.next(data),
        error: (error) => console.log("Hiba! Termékek lekérdezése sikertelen!", error)
      }
    )
  }

  private loadOrders() {
    this.http.get(this.apiUrl + "orders").subscribe({
      next: (data: any) => {
        const convertOrders = Object.keys(data).map(id => {
          const order = { id, ...data[id] }
          if (order.items && typeof order.items === "string") {
            try {
              order.items = JSON.parse(order.items)
            } catch (error) {
              console.error("Hiba! A rendelés termékeinek átalakításakor!", order.id, error)
              order.items = []
            }
          }
          return order
        })
        this.ordersSubject.next(convertOrders);
      },
      error: (error) => console.log("Hiba! Rendelések lekérdezése sikertelen!", error)
    })
  }

  public registerUser(user:any) {
    return this.http.post(this.apiUrl+"register", user).pipe(tap(() => this.loadUsers()))
  }

  public loginUser(user:any) {
    return this.http.post(this.apiUrl+"login", user)
  }

  public getUserData() {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.get(this.apiUrl+"getuser", { headers });
  }

  public logoutUser() {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.post(this.apiUrl+"logout", {}, { headers });
  }

  public updateUser(user:any) {
    return this.http.put(this.apiUrl+"users/update", user).pipe(tap(() => this.loadUsers()))
  }

  public changePassword(password:any) {
    const token = localStorage.getItem("authToken")
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`)
    return this.http.post(this.apiUrl+"change-password", password, { headers })
  }

  public changeEmail(email:any) {
    const token = localStorage.getItem("authToken")
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`)
    return this.http.post(this.apiUrl+"change-email", email, { headers })
  }

  public setAdmin(user:any) {
    return this.http.put(this.apiUrl+"users/set-admin", user).pipe(tap(() => this.loadUsers()))
  }

  public deleteUser(user:any) {
    return this.http.delete(this.apiUrl+"users/delete", {body: {id: user.id}}).pipe(tap(() => this.loadUsers()))
  }

  public addProduct(product:any) {
    return this.http.post(this.apiUrl+"addproduct", product).pipe(tap(() => this.loadProducts()))
  }

  public updateProduct(product:any) {
    return this.http.post(this.apiUrl+"updateproduct", product).pipe(tap(() => this.loadProducts()))
  }

  public deleteProduct(product:any) {
    return this.http.delete(this.apiUrl+"productdestroy", {body: {id: product.id}}).pipe(tap(() => this.loadProducts()))
  }

  public oneProduct(productId:string) {
    return this.http.get(this.apiUrl+"productshow", {params: {id: productId}})
  }

  public createOrder(orderItems:any) {
    return this.http.post(this.apiUrl+"addorder", orderItems).pipe(tap(() => this.loadOrders()))
  }

  public updateOrder(order:any) {
    return this.http.post(this.apiUrl+"updateorder", order).pipe(tap(() => this.loadOrders()))
  }

  public deleteOrder(order:any) {
    return this.http.delete(this.apiUrl+"orderdestroy", {body: {id: order.id}}).pipe(tap(() => this.loadOrders()))
  }

  public getOrdersByUser(userId:string) {
    return this.http.get(this.apiUrl+"getcustomersorders", {params: {user_id: userId}})
  }


  // E-mail kezelés
  public successRegistration(user:any) {
    return this.http.post(this.apiUrl+"successregistration", user)
  }

  public successOrder(order:any) {
    return this.http.post(this.apiUrl+"successorder", order)
  }

  public successChangeEmail(password:any) {
    return this.http.post(this.apiUrl+"changeemailmail", password)
  }

  public successChangePassword(email:any) {
    return this.http.post(this.apiUrl+"changepasswordmail", email)
  }
}