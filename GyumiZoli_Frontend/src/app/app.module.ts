import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NavbarComponent } from './components/navbar/navbar.component';
import { HomeComponent } from './components/home/home.component';
import { FruitsComponent } from './components/fruits/fruits.component';
import { VegetablesComponent } from './components/vegetables/vegetables.component';
import { SaleComponent } from './components/sale/sale.component';
import { ErrorpageComponent } from './components/errorpage/errorpage.component';
import { LoginComponent } from './components/login/login.component';
import { RegistrationComponent } from './components/registration/registration.component';
import { AboutusComponent } from './components/aboutus/aboutus.component';
import { FooterComponent } from './components/footer/footer.component';
import { ProductDetailComponent } from './components/product-detail/product-detail.component';
import { ProfileComponent } from './components/profile/profile.component';
import { AdminProfileComponent } from './components/admin-profile/admin-profile.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AdminLoginComponent } from './components/admin-login/admin-login.component';
import { AdminUsersComponent } from './components/admin-users/admin-users.component';
import { provideHttpClient } from '@angular/common/http';
import { AdminProductsComponent } from './components/admin-products/admin-products.component';
import { AdminUserSearchPipe } from './pipes/admin-user-search.pipe';
import { AdminProductSearchPipe } from './pipes/admin-product-search.pipe';
import { BasketComponent } from './components/basket/basket.component';
import { AdminOrdersComponent } from './components/admin-orders/admin-orders.component';

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    HomeComponent,
    FruitsComponent,
    VegetablesComponent,
    SaleComponent,
    ErrorpageComponent,
    LoginComponent,
    RegistrationComponent,
    AboutusComponent,
    FooterComponent,
    ProductDetailComponent,
    ProfileComponent,
    AdminProfileComponent,
    AdminLoginComponent,
    AdminUsersComponent,
    AdminProductsComponent,
    AdminUserSearchPipe,
    AdminProductSearchPipe,
    BasketComponent,
    AdminOrdersComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [provideHttpClient()],
  bootstrap: [AppComponent]
})
export class AppModule { }
