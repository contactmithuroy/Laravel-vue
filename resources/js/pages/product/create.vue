<template>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card-header d-flex justify-content-between align-item-center">
                  <h5>Create Product</h5>
                <router-link :to="{name:'product-list'}" class="btn btn-primary btn-sm">Product List</router-link>
              </div>
               <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="card card-primary">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-8 offset-lg-3 offset-md-2">
                            <!-- form start -->
                            <form role="form" @submit.prevent="createProduct">
                                <div class="row mt-5">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="title"  v-model="productForm.title" name="title" class="form-control" id="title" :class="{'is-invalid': productForm.errors.has('title')}" placeholder="Enter title">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="price"  v-model="productForm.price" name="price" class="form-control" id="price" :class="{'is-invalid': productForm.errors.has('price')}" placeholder="Enter price">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select v-model="productForm.category_id" name="category_id" id="category_id" :class="{'is-invalid': productForm.errors.has('category_id')}" class="form-control" >
                                            <option value="" style="display: none" selected >Please select</option>
                                            <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                                            <!-- @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach -->
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                           <label for="Image">Image</label>
                                           <div class="input-group">
                                              <div class="custom-file">
                                                 <input type="file" @change="onImageChange" name="image" class="custom-file-input" id="Image">
                                                 <label class="custom-file-label" for="Image">Choose Image</label>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea v-model="productForm.description" :class="{'is-invalid': productForm.errors.has('description')}"  name="description"  id="description" rows="4" class="form-control" placeholder="Enter your description">
                                            
                                            </textarea>
                                        </div>
                                    </div>   

                                    <div class="col-md-8">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" v-model="productForm.status" name="status" type="checkbox" id="status" >
                                            <label class="form-check-label" for="status">Is show your home page?</label>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->               
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
      </div>
  </div>
</template>

<script>
import Form from 'vform'
import{objectToFormData} from 'object-to-formData'
export default {
    data(){
       return{
           productForm: new Form({
                title:'',
                price:'',
                category_id:'',
                image:'',
                description:'',
                status:0,
            }),
            categories:[],  
       }     
    },
    methods:{
        loadCategory(){
            axios.get('/api/product/create')
            .then(response =>{
                console.log(response);
                this.categories = response.data;
            });
        },
        createProduct(){
            this.productForm.post('/api/product',{
                transformRequest:[function(data, headers){
                    return objectToFormData(data)
                }],
                onUploadProgress: e =>{
                    console.log(e)
                }
            }).then(({data})=>{
                console.log(data);
                this.productForm.title = '';
                this.productForm.price = '';
                this.productForm.category_id = '';
                this.productForm.description = '';
                this.productForm.status = false;
                this.$swal.fire(
                    'Done!',
                    'product Create Successfully!',
                    'success'
                );         
            });
            console.log('form submited');
        },

        onImageChange(e){
            const file = e.target.files[0]
            this.productForm.image = file
        },

    },

        mounted(){
        this.loadCategory();
        }
}
</script>

<style>

</style>