import { Component, ElementRef, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { BaseService } from '../../services/base.service';

@Component({
  selector: 'app-admin-products',
  templateUrl: './admin-products.component.html',
  styleUrl: './admin-products.component.css'
})
export class AdminProductsComponent {
  @ViewChild("fileInput") fileInput!: ElementRef
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

  removeImage() {
    this.selectedProduct.imageUrl = ""
    this.productForm.patchValue({image_url: ""})
  }

  onFileSelect(event: Event) {
    const input = event.target as HTMLInputElement
    if(input.files && input.files.length > 0) {
      const file = input.files[0]
      const allowedTypes = ["image/jpeg", "image/jpg", "image/png"]
      if(allowedTypes.includes(file.type)) {
        this.selectedFile = file
      }
      else {
        console.log("Hiba! Csak JPEG, JPG és PNG fájlok tölthetők fel!")
      }
    }
  }

  addProduct() {
    const newProductData = new FormData()
    Object.keys(this.newProductForm.value).forEach(key => {
      newProductData.append(key, this.newProductForm.value[key])
    })
    if(this.selectedFile) {
      newProductData.append("image_url", this.selectedFile)
    }
    this.base.addProduct(newProductData)
    this.newProductForm.reset()
    this.selectedFile = null
    this.fileInput.nativeElement.value = ""
  }

  chooseEditProduct(product:any) {
    this.selectedProduct = {...product}
    this.productForm.patchValue(this.selectedProduct)
  }

  editProduct() {
    const formData = new FormData();
    Object.keys(this.productForm.value).forEach(key => {
      formData.append(key, this.productForm.value[key]);
    });
    if (this.selectedFile) {
      formData.append('image_url', this.selectedFile);
    }
    this.base.updateProduct(formData)
    this.selectedFile = null
    this.selectedProduct = {}
    this.fileInput.nativeElement.value = ""
  }

  chooseDeleteProduct(product:any) {
    this.selectedProduct = {...product}
  }

  deleteProduct() {
    this.base.deleteProduct(this.selectedProduct)
    this.selectedProduct = {}
  }
}