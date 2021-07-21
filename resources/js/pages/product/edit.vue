<template>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card-header d-flex justify-content-between align-item-center">
                  <h5>Edit Category {{ categoryForm.name}}</h5>
                <router-link :to="{name:'category-list'}" class="btn btn-primary btn-sm">Category List</router-link>
              </div>
               <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="card card-primary">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-8 offset-lg-3 offset-md-2">
                            <!-- form start -->
                            <form role="form" @submit.prevent="updateCategory">
                                <div class="row mt-5">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="name">Category Name</label>
                                            <input type="name"  v-model="categoryForm.name" name="name" class="form-control" id="name" :class="{'is-invalid': categoryForm.errors.has('name')}" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" v-model="categoryForm.status" name="status" type="checkbox" id="status" >
                                            <label class="form-check-label" for="status">Is show your home page?</label>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->               
                                <div class="card-footer">
                                    <input type="hidden" id="category_id" v-model="categoryForm.id" name="id">
                                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
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
export default {
    data(){
       return{
           categoryForm: new Form({
                id:'',
                name:'',
                status:'',
            }),  
       }     
    },
    methods:{
        updateCategory(){
            var  id = document.getElementById('category_id').value;
            console.log(id);
            this.categoryForm.put(`/api/category/${id}`)
            .then(()=>{
                this.$swal.fire(
                    'Done!',
                    'Category Update Successfully!',
                    'success'
                );      
            }).catch(() =>{
                this.$Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    });
            });
            console.log('form submited');
        },
        loadCategory(){
            let slug = this.$route.params.slug;
             let id = (this.$route.params.id)
            console.log(id)
            axios.get(`/api/category/${id}/edit`).then(response =>{
                console.log(response);
                this.categoryForm.id = response.data.id;
                this.categoryForm.name = response.data.name;
                this.categoryForm.status = response.data.status;
            });
        }

    },
     mounted() {
            this.loadCategory();
    }
}
</script>

<style>

</style>