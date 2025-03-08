import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { FruitsComponent } from './components/fruits/fruits.component';
import { VegetablesComponent } from './components/vegetables/vegetables.component';
import { LoginComponent } from './components/login/login.component';
import { RegistrationComponent } from './components/registration/registration.component';
import { SaleComponent } from './components/sale/sale.component';
import { AboutusComponent } from './components/aboutus/aboutus.component';
import { AdminProfileComponent } from './components/admin-profile/admin-profile.component';
import { AdminLoginComponent } from './components/admin-login/admin-login.component';
import { AdminUsersComponent } from './components/admin-users/admin-users.component';
import { AdminProductsComponent } from './components/admin-products/admin-products.component';
import { ProductDetailComponent } from './components/product-detail/product-detail.component';
import { ProfileComponent } from './components/profile/profile.component';
import { ErrorpageComponent } from './components/errorpage/errorpage.component';

const routes: Routes = [
  {path: "home", component: HomeComponent},
  {path: "fruits", component: FruitsComponent},
  {path: "vegetables", component: VegetablesComponent},
  {path: "login", component: LoginComponent},
  {path: "registration", component: RegistrationComponent},
  {path: "sale", component: SaleComponent},
  {path: "aboutus", component: AboutusComponent},
  {path: "admin/profile", component: AdminProfileComponent},
  {path: "admin/login", component: AdminLoginComponent},
  {path: "admin/users", component: AdminUsersComponent},
  {path: "admin/products", component: AdminProductsComponent},
  {path: ":category/:id", component: ProductDetailComponent},
  {path: "profile", component: ProfileComponent},
  {path: "", redirectTo: "home", pathMatch: "full"},
  {path: "**", component: ErrorpageComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }