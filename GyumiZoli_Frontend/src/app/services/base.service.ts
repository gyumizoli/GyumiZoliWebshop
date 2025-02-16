import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class BaseService {
  private apiUrl = "http://127.0.0.1:8000/api/"

  private userSubject = new BehaviorSubject([])

  constructor(private http: HttpClient) {
    this.loadUsers()
  }

  getUsers() {
    return this.userSubject
  }

  private loadUsers() {
    this.http.get(this.apiUrl+"users").subscribe(
      {
        next: (data:any) => this.userSubject.next(data),
        error: (error) => console.log("Hiba! Felhasználók betöltése sikertelen!", error)
      }
    )
  }

  public addUser(user:any) {
    this.http.post(this.apiUrl+"register", user).subscribe(
      {
        next: () => this.loadUsers(),
        error: (error) => console.log("Hiba! Felhasználói regisztrációs sikertelen!", error)
      }
    )
  }

  public updateUser(user:any) {
    this.http.put(this.apiUrl+"users/update", user).subscribe(
      {
        next: () => this.loadUsers(),
        error: (error) => console.log("Hiba! Felhasználó frissítése sikertelen!", error)
      }
    )
  }

  public setAdmin(user:any) {
    this.http.put(this.apiUrl+"users/set-admin", user).subscribe(
      {
        next: () => this.loadUsers(),
        error: (error) => console.log("Hiba! Jogosultság beállítása sikertelen!", error)
      }
    )
  }

  public deleteUser(user:any) {
    this.http.delete(this.apiUrl+"users/delete", {body: {id: user.id}}).subscribe(
      {
        next: () => this.loadUsers(),
        error: (error) => console.log("Hiba! Felhasználó törlése sikertelen!", error)
      }
    )
  }
}