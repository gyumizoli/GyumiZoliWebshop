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
    { key: "roles", title: "Jogosultság", type: "select",
      options: [
        { value: 0, text: "felhasználó" },
        { value: 1, text: "admin"}
      ]
    },
    { key: "created_at", title: "Regisztrált", type: "plain"},
    { key: "updated_at", title: "Adatfrissítve", type: "plain"}
  ]

  constructor(private base: BaseService) {}

  addUser() {}

  chooseEditUser() {}

  editUser() {}

  chooseDeleteUser() {}

  deleteUser() {}
}
