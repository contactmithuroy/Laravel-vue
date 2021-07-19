<template>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card-header d-flex justify-content-between align-item-center">
                  <h5>Create Category</h5>
                <router-link :to="{name:'category-list'}" class="btn btn-primary btn-sm">Category List</router-link>
              </div>
               <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="card card-primary">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-8 offset-lg-3 offset-md-2">
                            <!-- form start -->
                            <form role="form" @submit.prevent="createCategory">
                              
                                <!-- <div class="alert alert-success success_alt mt-3 hide" role="alert" id="s_message">
                                    Your Data has been submit successfully!
                                </div> -->
                                <div class="row mt-5">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="name">Category Name</label>
                                            <input type="name"  v-model="categoryForm.name" name="name" class="form-control" id="name" :class="{'is-invalid': categoryForm.errors.has('name')}" placeholder="Enter name">
                                            <!-- <div v-if="categoryForm.errors.has('name')" v-html="categoryForm.errors.get('name')" /> -->
                                            <!-- <has-error :form="categoryForm" field="name"> </has-error> -->
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
export default {
    data(){
       return{
           categoryForm: new Form({
                name:'',
                status:'',
            }),  
       }     
    },
    methods:{
        createCategory(){
            this.categoryForm.post('/api/category')
            .then(({data})=>{
                console.log(data);
                this.categoryForm.name = '';
                this.categoryForm.status = false;
                this.$swal.fire(
                    'Done!',
                    'Category Create Successfully!',
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

    }
}
</script>

<style>

</style>