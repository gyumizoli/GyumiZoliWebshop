import { Component } from '@angular/core';
import { BaseService } from '../../services/base.service';
import { SearchService } from '../../services/search.service';

@Component({
  selector: 'app-admin-users',
  host: {
    class: "shaping"
  },
  templateUrl: './admin-users.component.html',
  styleUrl: './admin-users.component.css'
})
export class AdminUsersComponent {
  newUser:any = {}
  users:any = []
  selectedUser:any = {}
  toastMessage = ""
  toastType = ""
  isToastVisible = false
  word = ""

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

  constructor(private base: BaseService, private search: SearchService) {
    this.base.getUsers().subscribe(
      {
        next: (data:any) => {
          if (!data || Object.keys(data).length === 0) {
            this.showToast("Nincsenek felhasználók!", "danger");
          }
          else {
            this.users = Object.keys(data).map(id => ({id, ...data[id]}));
            this.showToast("Felhasználók betöltve!", "success");
          }
        },
        error: (error) => console.log("Hiba! Felhasználók betöltése sikertelen!", error)
      }
    )

    this.search.getSearchingWord().subscribe(
      (data) => this.word = data
    )
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
  }

  addUser() {
    const data = {
      email: this.newUser.email,
      name: this.newUser.name,
      password: this.newUser.password
    }

    this.base.addUserAdmin(this.newUser).subscribe(
      {
        next: () => {
          this.base.sendAddUserMail(data).subscribe(
            {
              next: () => this.showToast("E-mail elküldve!", "success"),
              error: (error) => {
                console.error("Hiba! E-mail küldése sikertelen!", error)
                this.showToast("Hiba! E-mail küldése sikertelen", "danger")
              }
            }
          )
          this.newUser = {}
          this.showToast("Felhasználó hozzáadása sikeres!", "success")
        },
        error: (error) => {
          console.error("Hiba! Felhasználó hozzáadása sikertelen!", error)
          this.showToast("Hiba! Felhasználó hozzáadása sikertelen", "danger")
        }
      }
    )
  }

  chooseEditUser(user:any) {
    this.selectedUser = {...user}
  }

  editUser() {
    this.base.updateUser(this.selectedUser).subscribe(
      {
        next: () => {
          this.selectedUser = {}
          this.showToast("Felhasználó frissítése sikeres!", "success")
        },
        error: (error) => {
          console.error("Hiba! Felhasználó módosítása sikertelen!", error)
          this.showToast("Hiba! Felhasználó módosítása sikertelen!", "danger")
        }
      }
    )

    this.base.setAdmin(this.selectedUser).subscribe(
      {
        next: () => {
          this.selectedUser = {}
          this.showToast("Admin jogosultság beállítása sikeres!", "success")
        },
        error: (error) => {
          console.error("Hiba! Admin jogosultság beállítása sikertelen!", error)
          this.showToast("Hiba! Admin jogosultság beállítása sikertelen!", "danger")
        }
      }
    )
  }

  chooseDeleteUser(user:any) {
    this.selectedUser = {...user}
  }

  deleteUser() {
    this.base.deleteUser(this.selectedUser).subscribe(
      {
        next: () => {
          this.selectedUser = {}
          this.showToast("Felhasználó törlése sikeres!", "success")
        },
        error: (error) => {
          console.error("Hiba! Felhasználó törlése sikertelen!", error)
          this.showToast("Hiba! Felhasználó törlése sikertelen!", "danger")
        }
      }
    )
  }

  setSearch(event:any) {
    this.search.setSearchingWord(event.target.value)
  }

  deleteSearch() {
    this.word = ""
  }
}