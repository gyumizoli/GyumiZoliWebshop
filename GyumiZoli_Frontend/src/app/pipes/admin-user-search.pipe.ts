import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'adminUserSearch'
})
export class AdminUserSearchPipe implements PipeTransform {
  transform(users:any[], word:string): any {
    if(!users) return null;
    if(!word) return users;
    return users.filter(
      (user) => {
        return (
          user.name.toLowerCase().includes(word.toLowerCase()) || 
          user.email.toLowerCase().includes(word.toLowerCase()) || 
          user.phone.toLowerCase().includes(word.toLowerCase()) || 
          user.address.toLowerCase().includes(word.toLowerCase())
        )
      }
    )
  }
}