<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5>Category Component</h5>
                        <router-link :to="{name:'create-category'}" class="btn btn-primary btn-sm">Create Category</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:100px">Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th style="width:170px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories" :key="category.id" >
                                    <td style="width:100px">{{category.id }}</td>
                                    <td>{{category.name }}</td>
                                    <td>{{category.slug }}</td>
                                    <td>
                                        <span v-if="category.status == 1" class="badge badge-success">Open</span>
                                        <span v-else class="badge badge-warning">Lock</span>
                                    </td>
                                    <td style="width:170px">
                                        <router-link :to="{name:'edit-category',params:{id:category.id}}" class="btn btn-primary btn-sm">Edit </router-link>
                                        <a href="#" @click.prevent="deleteCategory(category)" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                categories:[],
            }
        },
        methods:{
            loadCategories(){
                axios.get('/api/category')
                .then(response =>{
                    this.categories = response.data;
                });
            },
            deleteCategory(category){
            this.$swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/category/${category.id}`)
                            .then(()=>{
                                this.$swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                                )
                        let index = this.categories.indexOf(category);
                        console.log(index);
                        this.categories.splice(index,1);
                        });
                    }
                });
               
            },
        },
        mounted() {
            this.loadCategories();
        }
    }
</script>
<!--
for delete vue data
at first declear @cleck.prevent method (deleteCategory(category(as a array)))

in script file call deleteCategory function
then confirm sweet alert
if isConfirmed->
    then axios.delete(`/api/category/${category.id}`)
        then->
            find category index on categories array 
            use let index = this.categories.indexOf(category);
            then->
                delete/splice this table row
                this.categories.splice(index,1);
 --!>