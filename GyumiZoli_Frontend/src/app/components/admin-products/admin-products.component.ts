import { Component, ElementRef, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { BaseService } from '../../services/base.service';
import { SearchService } from '../../services/search.service';

@Component({
  selector: 'app-admin-products',
  host: {
    class: "shaping"
  },
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
  toastMessage = ""
  toastType = ""
  isToastVisible = false
  word = ""

  columns:any[] = [
    { key: "id", title: "ID", type: "plain" },
    { key: "name", title: "Név", type: "text" },
    { key: "description", title: "Leírás", type: "text" },
    { key: "price", title: "Ár", type: "number" },
    { key: "category", title: "Kategória", type: "select",
      options: [
        { value: "Zöldség", text: "Zöldség" },
        { value: "Gyümölcs", text: "Gyümölcs" }
      ]
    },
    { key: "unit", title: "Mértékegység", type: "select",
      options: [
        { value: "kg", text: "kg" },
        { value: "dkg", text: "dkg" },
        { value: "g", text: "g" },
        { value: "db", text: "db" }
      ]
    },
    { key: "stock", title: "Raktáron", type: "number" },
    { key: "promotion", title: "Akciós", type: "select",
      options: [
        { value: 1, text: "Igen" },
        { value: 0, text: "Nem" }
      ]
    },
    { key: "discount_price", title: "Akciós ár", type: "number" },
    { key: "created_at", title: "Felvéve", type: "plain" },
    { key: "updated_at", title: "Módosítva", type: "plain" }
  ]

  constructor(private base: BaseService, private formBuilder: FormBuilder, private search: SearchService) {
    this.base.getProducts().subscribe(
      {
        next: (data:any) => {
          if (!data || Object.keys(data).length === 0) {
            this.showToast("Nincsenek termékek!", "danger");
          }
          else {
            this.products = Object.keys(data).map(id => ({id, ...data[id]}));
            this.showToast("Termékek betöltve!", "success");
          }
        },
        error: (error) => console.log("Hiba! Termékek betöltése sikertelen!", error)
      }
    )

    this.search.getSearchingWord().subscribe(
      (data) => this.word = data
    )

    this.newProductForm = this.createNewForm()
    this.productForm = this.createForm()
  }

  private createNewForm(): FormGroup {
    let formGroup:any = {}
    this.columns.forEach(column => formGroup[column.key] = [""])
    return this.formBuilder.group(formGroup)
  }

  private createForm(): FormGroup {
    let formGroup:any = {}
    this.columns.forEach(column => formGroup[column.key] = [""])
    formGroup["image_url"] = [""]
    return this.formBuilder.group(formGroup)
  }

  showToast(message:string, type:string) {
    this.toastMessage = message
    this.toastType = type
    this.isToastVisible = true
    setTimeout(() => this.isToastVisible = false, 4000)
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

  confirmImageDelete() {
    if (confirm("Biztosan törölni szeretnéd a képet?")) {
      this.removeImage();
      this.productForm.patchValue({ delete_image: true });
      this.editProduct();
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
    this.base.addProduct(newProductData).subscribe(
      {
        next: () => {
          this.newProductForm.reset()
          this.selectedFile = null
          this.fileInput.nativeElement.value = ""
          this.showToast("Termék hozzáadva!", "success");
        },
        error: (error) => {
          console.log("Hiba! Termék hozzáadása sikertelen!", error),
          this.showToast("Hiba! Termék hozzáadása sikertelen!", "danger")
        }
      }
    )
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
    this.base.updateProduct(formData).subscribe(
      {
        next: () => {
          this.selectedFile = null
          this.selectedProduct = {}
          this.fileInput.nativeElement.value = ""
          this.showToast("Termék módosítva!", "success");
        },
        error: (error) => {
          console.log("Hiba! Termék módosítása sikertelen!", error);
          this.showToast("Hiba! Termék módosítása sikertelen!", "danger");
        }
      }
    )
  }

  chooseDeleteProduct(product:any) {
    this.selectedProduct = {...product}
  }

  deleteProduct() {
    this.base.deleteProduct(this.selectedProduct).subscribe(
      {
        next: () => {
          this.selectedProduct = {}
          this.showToast("Termék törölve!", "success");
        },
        error: (error) => {
          console.log("Hiba! Termék törlése sikertelen!", error);
          this.showToast("Hiba! Termék törlése sikertelen!", "danger");
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