import { Injectable } from '@angular/core';
import { BehaviorSubject, catchError, finalize, Observable, of, tap } from 'rxjs';
import { BaseService } from './base.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private loggedUserSubject = new BehaviorSubject<any>(null)
  private adminSubject = new BehaviorSubject<boolean>(false)

  constructor(private base: BaseService) {
    this.checkAuthState()
  }

  private checkAuthState() {
    const token = localStorage.getItem("authToken")
    if (token) {
      this.base.getUserData().subscribe(
        {
          next: (response: any) => {
            const userData = response.data
            this.loggedUserSubject.next(userData)
            this.adminSubject.next(userData && userData.admin == 1)
          },
          error: (error) => {
            console.log("Authentikációs hiba!", error)
            this.loggedUserSubject.next(null)
            this.adminSubject.next(false)
          }
        }
      )
    }
  }

  login(email: string, password: string): Observable<any> {
    const credentials = {email, password}
    return this.base.loginUser(credentials).pipe(
      tap((response: any) => {
        localStorage.setItem("authToken", response.data.token)
        this.checkAuthState()
      })
    )
  }

  register(user: any): Observable<any> {
    return this.base.registerUser(user)
  }

  logout() {
    return this.base.logoutUser().pipe(
      catchError(error => {
        // console.error("Kijelentkezési hiba:", error)
        return of (null)
      }),
      finalize(() => {
        localStorage.removeItem("authToken")
        this.loggedUserSubject.next(null)
        this.adminSubject.next(false)
      })
    )
  }

  getLoggedUser(): Observable<any> {
    return this.loggedUserSubject.asObservable()
  }

  getIsAdmin(): Observable<boolean> {
    return this.adminSubject.asObservable()
  }
}