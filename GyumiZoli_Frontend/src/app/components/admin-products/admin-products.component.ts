import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-admin-products',
  templateUrl: './admin-products.component.html',
  styleUrl: './admin-products.component.css'
})
export class AdminProductsComponent {
  newProductForm: FormGroup
  productForm: FormGroup
  products:any = []
  selectedProduct:any = {}
  selectedFile:File | null = null

  columns = [
    { key: "id", title: "ID", type: "plain" },
    { key: "name", title: "Név", type: "text" },
    { key: "description", title: "Leírás", type: "text" },
    { key: "price", title: "Ár", type: "number" },
    { key: "category_id", title: "Kategória", type: "select",
      options: [
        { value: 1, text: "Zöldség" },
        { value: 2, text: "Gyümölcs" }
      ]
    },
    { key: "created_at", title: "Felvéve", type: "plain" },
    { key: "updated_at", title: "Módosítva", type: "plain" }
  ]

  constructor(private base: BaseService, private formBuilder: FormBuilder) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => this.products = Object.keys(data || {}).map(id => ({id, ...data[id]})),
        error: (error) => console.log("Hiba! Termékek betöltése sikertelen!", error)
      }
    )

    this.newProductForm = this.createForm()
    this.productForm = this.createForm()
  }

  private createForm(): FormGroup {
    let formGroup:any = {}
    this.columns.forEach(column => formGroup[column.key] = [""])
    return this.formBuilder.group(formGroup)
  }

  addProduct() {}

  chooseEditProduct() {}

  editProduct() {}

  chooseDeleteProduct() {}

  deleteProduct() {}
}