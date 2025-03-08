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

  constructor(private http: HttpClient) {
    this.loadUsers()
    this.loadProducts()
  }

  getUsers() {
    return this.userSubject
  }

  getProducts() {
    return this.productsSubject
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

  public addUser(user:any) {
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

  public setAdmin(user:any) {
    return this.http.put(this.apiUrl+"users/set-admin", user).pipe(tap(() => this.loadUsers()))
  }

  public deleteUser(user:any) {
    return this.http.delete(this.apiUrl+"users/delete", {body: {id: user.id}}).pipe(tap(() => this.loadUsers()))
  }

  public addProduct(product:any) {
    return this.http.post(this.apiUrl+"addproduct", product).pipe(tap(() => this.loadUsers()))
  }

  public updateProduct(product:any) {
    return this.http.post(this.apiUrl+"updateproduct", product).pipe(tap(() => this.loadUsers()))
  }

  public deleteProduct(product:any) {
    return this.http.delete(this.apiUrl+"productdestroy", {body: {id: product.id}}).pipe(tap(() => this.loadUsers()))
  }

  public oneProduct(productId:string) {
    return this.http.get(this.apiUrl+"productshow", {params: {id: productId}})
  }
}