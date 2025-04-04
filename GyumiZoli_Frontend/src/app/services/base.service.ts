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
    if (localStorage.getItem("authToken")) {
      this.loadUsers()
      this.loadOrders()
    }
    this.loadProducts()
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

  public loadUsers() {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    this.http.get(this.apiUrl + "users", {headers}).subscribe(
      {
        next: (data: any) => this.userSubject.next(data),
        error: (error) => console.log("Hiba! Felhasználók betöltése sikertelen!", error)
      }
    )
  }

  public loadProducts() {
    this.http.get(this.apiUrl+"products").subscribe(
      {
        next: (data:any) => this.productsSubject.next(data),
        error: (error) => console.log("Hiba! Termékek lekérdezése sikertelen!", error)
      }
    )
  }

  public loadOrders() {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    this.http.get(this.apiUrl + "orders", {headers}).subscribe({
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

  public addUserAdmin(user:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.post(this.apiUrl+"users/add", user, {headers}).pipe(tap(() => this.loadUsers()))
  }

  public registerUser(user:any) {
    return this.http.post(this.apiUrl+"register", user)
  }

  public loginUser(user:any) {
    return this.http.post(this.apiUrl+"login", user)
  }

  public getUserData() {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.get(this.apiUrl+"getuser", {headers});
  }

  public logoutUser() {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.post(this.apiUrl+"logout", {}, {headers});
  }

  public updateUser(user:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.put(this.apiUrl+"users/update", user, {headers}).pipe(tap(() => this.loadUsers()))
  }

  public changePassword(password:any) {
    const token = localStorage.getItem("authToken")
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`)
    return this.http.post(this.apiUrl+"change-password", password, {headers})
  }

  public changeAddress(address:any) {
    const token = localStorage.getItem("authToken")
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`)
    return this.http.post(this.apiUrl+"change-address", address, {headers})
  }

  public setAdmin(user:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.put(this.apiUrl+"users/set-admin", user, {headers}).pipe(tap(() => this.loadUsers()))
  }

  public deleteUser(user: any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.delete(this.apiUrl + "users/delete", {headers, body: {id: user.id} }).pipe(tap(() => this.loadUsers()))
  }

  public addProduct(product:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.post(this.apiUrl+"addproduct", product, {headers}).pipe(tap(() => this.loadProducts()))
  }

  public updateProduct(product:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.post(this.apiUrl+"updateproduct", product, {headers}).pipe(tap(() => this.loadProducts()))
  }

  public deleteProduct(product:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.delete(this.apiUrl+"productdestroy", {headers, body: {id: product.id}}).pipe(tap(() => this.loadProducts()))
  }

  public oneProduct(productId:string) {
    return this.http.get(this.apiUrl+"productshow", {params: {id: productId}})
  }

  public createOrder(orderItems:any) {
    return this.http.post(this.apiUrl+"addorder", orderItems).pipe(tap(() => this.loadOrders()))
  }

  public updateOrder(order:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.post(this.apiUrl+"updateorder", order, {headers}).pipe(tap(() => this.loadOrders()))
  }

  public deleteOrder(order:any) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.delete(this.apiUrl+"orderdestroy", {headers, body: {id: order.id}}).pipe(tap(() => this.loadOrders()))
  }

  public getOrdersByUser(userId:string) {
    const token = localStorage.getItem("authToken");
    const headers = new HttpHeaders().set("Authorization", `Bearer ${token}`);
    return this.http.get(this.apiUrl+"getcustomersorders", {headers, params: {user_id: userId}})
  }


  // E-mail kezelés
  public successRegistration(user:any) {
    return this.http.post(this.apiUrl+"successregistration", user)
  }

  public successOrder(order:any) {
    return this.http.post(this.apiUrl+"successorder", order)
  }

  public successChangeAddress(address:any) {
    return this.http.post(this.apiUrl+"changeaddressmail", address)
  }

  public successChangePassword(password:any) {
    return this.http.post(this.apiUrl+"changepasswordmail", password)
  }

  public sendOrderStatus(order:any) {
    return this.http.post(this.apiUrl+"orderstatus", order)
  }

  public sendAddUserMail(user:any) {
    return this.http.post(this.apiUrl+"adduseremail", user)
  }
}