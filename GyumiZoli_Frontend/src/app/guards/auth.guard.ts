import { inject } from '@angular/core';
import { CanActivateFn } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { filter, map } from 'rxjs';

export const authGuard: CanActivateFn = (route, state) => {
  const auth = inject(AuthService)

  return auth.getLoggedUser().pipe(
    filter(user => user !== null),
    map(user => {
      return true
    })
  )
}