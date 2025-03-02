import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-admin-users',
  templateUrl: './admin-users.component.html',
  styleUrl: './admin-users.component.css'
})
export class AdminUsersComponent {
  newUser:any = {}
  users:any = []
  selectedUser:any = {}

  columns = [
    { key: "id", title: "ID", type: "plain" },
    { key: "name", title: "Név", type: "text" },
    { key: "email", title: "E-mail", type: "email" },
    { key: "phone", title: "Telefonszám", type: "phone" },
    { key: "address", title: "Cím", type: "text" },
    { key: "birth_date", title: "Születési dátum", type: "date"},
    { key: "admin", title: "Jogosultság", type: "select",
      options: [
        { value: 0, text: "felhasználó" },
        { value: 1, text: "admin"}
      ]
    },
    { key: "created_at", title: "Regisztrált", type: "plain"},
    { key: "updated_at", title: "Adatfrissítve", type: "plain"}
  ]

  constructor(private base: BaseService) {
    this.base.getUsers().subscribe(
      {
        next: (data:any) => this.users = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.log("Hiba! Adatok betöltése sikertelen!", error)
      }
    )
  }

  addUser() {
    this.base.addUser(this.newUser).subscribe(
      {
        next: () => this.newUser = {},
        error: (error) => console.error("Hiba! Felhasználó hozzáadása sikertelen!", error) 
      }
    )
  }

  chooseEditUser(user:any) {
    this.selectedUser = {...user}
  }

  editUser() {
    this.base.updateUser(this.selectedUser).subscribe(
      {
        next: () => this.selectedUser = {},
        error: (error) => console.error("Hiba! Felhasználó módosítása sikertelen!", error)
      }
    )
    this.base.setAdmin(this.selectedUser).subscribe(
      {
        next: () => this.selectedUser = {},
        error: (error) => console.error("Hiba! Admin jogosultság beállítása sikertelen!", error)
      }
    )
  }

  chooseDeleteUser(user:any) {
    this.selectedUser = {...user}
  }

  deleteUser() {
    this.base.deleteUser(this.selectedUser).subscribe(
      {
        next: () => this.selectedUser = {},
        error: (error) => console.error("Hiba! Felhasználó törlése sikertelen!", error)
      }
    )
  }
}