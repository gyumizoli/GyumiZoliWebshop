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
import { AdminUsersComponent } from './components/admin-users/admin-users.component';
import { AdminProductsComponent } from './components/admin-products/admin-products.component';
import { ProductDetailComponent } from './components/product-detail/product-detail.component';
import { ProfileComponent } from './components/profile/profile.component';
import { ErrorpageComponent } from './components/errorpage/errorpage.component';
import { BasketComponent } from './components/basket/basket.component';
import { AdminOrdersComponent } from './components/admin-orders/admin-orders.component';
import { ShippingDetailsComponent } from './components/shipping-details/shipping-details.component';
import { adminGuard } from './guards/admin.guard';
import { authGuard } from './guards/auth.guard';
import { SearchComponent } from './components/search/search.component';
import { PaymentComponent } from './components/payment/payment.component';

const routes: Routes = [
  {path: "home", component: HomeComponent},
  {path: "fruits", component: FruitsComponent},
  {path: "vegetables", component: VegetablesComponent},
  {path: "login", component: LoginComponent},
  {path: "registration", component: RegistrationComponent},
  {path: "sale", component: SaleComponent},
  {path: "aboutus", component: AboutusComponent},
  {path: "admin/profile", component: AdminProfileComponent, canActivate: [adminGuard]},
  {path: "admin/users", component: AdminUsersComponent, canActivate: [adminGuard]},
  {path: "admin/products", component: AdminProductsComponent, canActivate: [adminGuard]},
  {path: "admin/orders", component: AdminOrdersComponent, canActivate: [adminGuard]},
  {path: ":category/:id", component: ProductDetailComponent},
  {path: "profile", component: ProfileComponent, canActivate: [authGuard]},
  {path: "basket", component: BasketComponent},
  {path: "basket-shipping-details", component: ShippingDetailsComponent},
  {path: "search-result", component: SearchComponent},
  {path: "payment-details", component: PaymentComponent},
  {path: "", redirectTo: "home", pathMatch: "full"},
  {path: "**", component: ErrorpageComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }